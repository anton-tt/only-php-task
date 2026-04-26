<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); //.default
$APPLICATION->SetTitle("Новости компании");?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	".default", 
	array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"SET_TITLE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"COMPONENT_TEMPLATE" => "custom_news",
		"FILTER_NAME" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>

<h2>Вакансии (инфоблок с id = 4)</h2>

<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "",
    [
        "IBLOCK_ID" => 4,
        "NEWS_COUNT" => 10,

        "SORT_BY1" => "ID",
        "SORT_ORDER1" => "DESC",

        "FIELD_CODE" => [
            "NAME",
            "PREVIEW_TEXT",
            "DETAIL_TEXT",
            "DATE_CREATE"
        ],

        "PROPERTY_CODE" => [
            "OFFICE",
            "LOCATION",
            "REQUIRE",
            "DUTY",
            "CONDITIONS",
            "EMAIL",
            "TYPE",
            "SALARY_TYPE",
            "SALARY_VALUE",
            "SCHEDULE"
        ],

        "CACHE_TYPE" => "N",
        "SET_TITLE" => "N"
    ]
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>