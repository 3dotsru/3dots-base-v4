<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"GROUPS" => [
		"SETTINGS" => [
			"NAME" => GetMessage("SETTINGS_PHR")
		],
		"PARAMS" => [
			"NAME" => "Параметры компонента"
		]
	],
	"PARAMETERS" => array(
		"IBLOCK_ID" =>  [
			"PARENT" => "PARAMS",
			"NAME" => "ID Инфоблока",
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"ADDITIONAL_VALUES" => "Y"
		],
		"FILTER_NAME" =>  [
			"PARENT" => "PARAMS",
			"NAME" => "Имя фильтра",
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"ADDITIONAL_VALUES" => "Y"
		]
	),
);
?>