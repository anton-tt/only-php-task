<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"custom_list",
	[
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"NEWS_COUNT" => 10,
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"FIELD_CODE" => ["NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DATE_ACTIVE_FROM"],
		"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
		"SET_TITLE" => "Y",
	],
	$component
);
