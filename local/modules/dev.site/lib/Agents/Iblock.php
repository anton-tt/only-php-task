<?php

namespace Dev\Site\Agents;

use Bitrix\Main\Loader;
use Bitrix\Iblock\IblockTable;

class Iblock
{

    public static function cleanLog()
    {
        if (!Loader::includeModule('iblock')) {
            return "\\Dev\\Site\\Agents\\Iblock::cleanLog();";
        }

        $logIblockId = 0;
        $iblock = IblockTable::getList([
            'filter' => ['CODE' => 'LOG'],
            'select' => ['ID']
        ])->fetch();
        if ($iblock) {
            $logIblockId = (int)$iblock['ID'];
        }
        if (!$logIblockId) {
            return "\\Dev\\Site\\Agents\\Iblock::cleanLog();";
        }

        $rs = \CIBlockElement::GetList(
            ['TIMESTAMP_X' => 'DESC', 'ID' => 'DESC'],
            ['IBLOCK_ID' => $logIblockId],
            false,
            [
                'nOffset' => 10,
                'nTopCount' => 50
            ],
            ['ID']
        );

        $toDelete = [];
        while ($el = $rs->Fetch()) {
            $toDelete[] = (int)$el['ID'];
        }
        foreach ($toDelete as $id) {
            \CIBlockElement::Delete($id);
        }
    
        return "\\Dev\\Site\\Agents\\Iblock::cleanLog();";
    }

}
