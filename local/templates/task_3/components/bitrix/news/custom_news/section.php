<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<pre><?print_r($arResult["VARIABLES"]);?></pre>
<?php $this->setFrameMode(true);

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "custom_list",
    [
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "NEWS_COUNT" => 10,
        "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
        "SET_TITLE" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
    ],
    $component
);