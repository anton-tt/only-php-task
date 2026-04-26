<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;
if (!$USER->IsAdmin()) {
    die("Доступ запрещён!");
}

\Bitrix\Main\Loader::includeModule('iblock');

$IBLOCK_ID = 4;
$arProps = [];

$el = new CIBlockElement;

$rsProp = CIBlockPropertyEnum::GetList(
    ["SORT" => "ASC", "VALUE" => "ASC"],
    ['IBLOCK_ID' => $IBLOCK_ID]
);
while ($arProp = $rsProp->Fetch()) {
    $key = trim($arProp['VALUE']);
    $arProps[$arProp['PROPERTY_CODE']][$key] = $arProp['ID'];
}

$rsElements = CIBlockElement::GetList([], ['IBLOCK_ID' => $IBLOCK_ID], false, false, ['ID']);
while ($element = $rsElements->GetNext()) {
    CIBlockElement::Delete($element['ID']);
}

$row = 0;
if (($handle = fopen("vacancy.csv", "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $row++;
        if ($row == 1) {
            continue;
        }

        $PROP = [];
        $PROP['ACTIVITY']    = $data[9];
        $PROP['FIELD']       = $data[11];
        $PROP['OFFICE']      = $data[1];
        $PROP['LOCATION']    = $data[2];
        $PROP['REQUIRE']     = $data[4];
        $PROP['DUTY']        = $data[5];
        $PROP['CONDITIONS']  = $data[6];
        $PROP['EMAIL']       = $data[12];
        $PROP['DATE']        = date('d.m.Y');
        $PROP['TYPE']        = $data[8];
        $PROP['SALARY_TYPE'] = $data[7];
        $PROP['SALARY_VALUE'] = $data[7];
        $PROP['SCHEDULE']    = $data[10];

        foreach ($PROP as $key => &$value) {
            $value = trim($value);
            $value = str_replace("\n", '', $value);

            if (in_array($key, ['REQUIRE', 'DUTY', 'CONDITIONS']) && stripos($value, '•') !== false) {
                $value = explode('•', $value);
                array_shift($value);
                foreach ($value as &$str) {
                    $str = trim($str);
                }
                unset($str);
            }

            if (is_array($value)) {
                continue;
            }

            if (empty($arProps[$key])) {
                continue;
            }

            $found = false;
            $best = 0;
            $bestVal = null;
            foreach ($arProps[$key] as $propKey => $propVal) {
                if ($value !== '' && stripos($propKey, $value) !== false) {
                    $value = $propVal;
                    $found = true;
                    break;
                }

                similar_text($propKey, $value, $percent);
                if ($percent > $best) {
                    $best = $percent;
                    $bestVal = $propVal;
                }
            }
            if (!$found && $bestVal !== null) {
                $value = $bestVal;
            }
        }
        unset($value);

        if (trim($data[3]) === '') {
            continue;
        }

        $arLoadProductArray = [
            "IBLOCK_ID" => $IBLOCK_ID,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $data[3],
            "ACTIVE" => "Y",
        ];

        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            echo "Добавлен элемент с ID : " . $PRODUCT_ID . "<br>";
        } else {
            echo "Error: " . $el->LAST_ERROR . '<br>';
        }
    }
    fclose($handle);
}
