<?php

namespace Dev\Site\Handlers;

class Iblock
{

    public static function handleElement($arFields)
    {
        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'] . '/local/event_debug.txt',
            "CLASS WORKS\n",
            FILE_APPEND
        );
    }
}
