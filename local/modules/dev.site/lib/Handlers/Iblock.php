<?php

namespace Dev\Site\Handlers;

class Iblock
{

    public static function handleElement($arFields)
    {
        static $running = false;
        if ($running) {
            return;
        }
        $running = true;

        $logIblock = \CIBlock::GetList([], ['CODE' => 'LOG'])->Fetch();
        if (!$logIblock) {
            return;
        }

        $logIblockId = (int)$logIblock['ID'];
        $iblockId = (int)$arFields['IBLOCK_ID'];
        if ($iblockId == $logIblockId) {
            return;
        }

        $elementId = (int)$arFields['ID'];
        $element = \CIBlockElement::GetByID($elementId)->Fetch();
        if (!$element) {
            return;
        }

        $iblock = \CIBlock::GetByID($iblockId)->Fetch();
        $logSection = \CIBlockSection::GetList(
            [],
            [
                'IBLOCK_ID' => $logIblockId,
                'CODE' => $iblock['CODE'],
                'SECTION_ID' => false
            ],
            false,
            ['ID']
        )->Fetch();
        $logSectionId = $logSection ? (int)$logSection['ID'] : 0;

        $iblockName = $iblock['NAME'] ?? '';
        if ($logSectionId === 0) {
            $bs = new \CIBlockSection;
            $newSectionId = $bs->Add(
                [
                    'IBLOCK_ID' => $logIblockId,
                    'NAME' => $iblockName,
                    'CODE' => $iblock['CODE'],
                    'ACTIVE' => 'Y',
                ]
            );
            if ($newSectionId) {
                $logSectionId = (int)$newSectionId;
            }
        }

        $sections = self::getSectionPath((int)$element['IBLOCK_SECTION_ID']);
        $currentSectionId = $logSectionId;
        foreach ($sections as $sectionName) {
            $code = \CUtil::translit($sectionName, 'ru', ['replace_space' => '-', 'replace_other' => '-']) . '-' . $currentSectionId;
            $section = \CIBlockSection::GetList(
                [],
                [
                    'IBLOCK_ID' => $logIblockId,
                    'CODE' => $code,
                    'SECTION_ID' => $currentSectionId
                ],
                false,
                ['ID']
            )->Fetch();
            $sectionId = $section ? (int)$section['ID'] : 0;

            if ($sectionId === 0) {
                $bs = new \CIBlockSection;
                $newId = $bs->Add(
                    [
                        'IBLOCK_ID' => $logIblockId,
                        'NAME' => $sectionName,
                        'CODE' => $code,
                        'ACTIVE' => 'Y',
                        'IBLOCK_SECTION_ID' => $currentSectionId,
                    ]
                );
                if ($newId) {
                    $sectionId = (int)$newId;
                }
            }
            $currentSectionId = $sectionId;
        }

        $elementName = $element['NAME'] ?? '';
        $pathParts = array_merge([$iblockName], $sections, [$elementName]);
        $path = implode(' -> ', $pathParts);
        
        $activeFrom = $arFields['TIMESTAMP_X']
            ?? $arFields['DATE_CREATE']
            ?? $element['TIMESTAMP_X']
            ?? $element['DATE_CREATE'];
        $arLogFields = [
            'IBLOCK_ID' => $logIblockId,
            'NAME' => (string) $elementId,
            'PREVIEW_TEXT' => $path,
            'ACTIVE' => 'Y',
            'ACTIVE_FROM' => $activeFrom,
            'IBLOCK_SECTION_ID' => $currentSectionId,
        ];
        $el = new \CIBlockElement;
        $el->Add($arLogFields);
    }

    private static function getSectionPath($sectionId)
    {
        if ($sectionId <= 0) {
            return [];
        }

        $section = \CIBlockSection::GetByID($sectionId)->Fetch();
        if (!$section) {
            return [];
        }

        $path = self::getSectionPath((int)$section['IBLOCK_SECTION_ID']);
        $path[] = $section['NAME'];
        return $path;
    }

}
