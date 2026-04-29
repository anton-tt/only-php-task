<?php

namespace Dev\Site\Handlers;

class Iblock
{

    public static function handleElement($arFields)
    {
        $iblockId = (int)$arFields['IBLOCK_ID'];
        $elementId = (int)$arFields['ID'];

        $logIblock = \CIBlock::GetList([], ['CODE' => 'LOG'])->Fetch();
        if (!$logIblock) {
            return;
        }

        $logIblockId = (int)$logIblock['ID'];
        if ($iblockId == $logIblockId) {
            return;
        }

        $iblock = \CIBlock::GetByID($iblockId)->Fetch();
        $iblockName = $iblock['NAME'];

        $element = \CIBlockElement::GetByID($elementId)->Fetch();
        if (!$element) {
    file_put_contents(
        $_SERVER['DOCUMENT_ROOT'] . '/local/event_debug.txt',
        "EXIT: element not found ID={$elementId}\n",
        FILE_APPEND
    );
    return;
}
        
        $elementName = $element['NAME'];

        $sectionId = (int)$element['IBLOCK_SECTION_ID'];
        $sectionName = '';

        if ($sectionId > 0) {
            $section = \CIBlockSection::GetByID($sectionId)->Fetch();
            $sectionName = $section['NAME'];
        }

        $path = $iblockName;
        if ($sectionName) {
            $path .= ' -> ' . $sectionName;
        }
        $path .= ' -> ' . $elementName;

        $el = new \CIBlockElement;
        $arLogFields = [
            'IBLOCK_ID' => $logIblockId,
            'NAME' => $path,
            'ACTIVE' => 'Y',
        ];
        $ID = $el->Add($arLogFields);

        if ($ID) {

    $log = "LOG CREATED: {$ID}\n";
    $log .= "ADD RESULT: " . var_export($ID, true) . PHP_EOL;

    file_put_contents(
        $_SERVER['DOCUMENT_ROOT'] . '/local/event_debug.txt',
        $log,
        FILE_APPEND
    );

} else {

    file_put_contents(
        $_SERVER['DOCUMENT_ROOT'] . '/local/event_debug.txt',
        "LOG ERROR: " . $el->LAST_ERROR . PHP_EOL,
        FILE_APPEND
    );
}
    }
}
