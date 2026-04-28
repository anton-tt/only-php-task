<?php

file_put_contents(
    $_SERVER['DOCUMENT_ROOT'] . '/local/module_test.txt',
    'module connected' . PHP_EOL,
    FILE_APPEND
);