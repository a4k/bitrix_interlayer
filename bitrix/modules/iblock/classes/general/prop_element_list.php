<?
use Bitrix\Iblock;


class CIBlockPropertyElementList
{
	const USER_TYPE = 'EList';

	public static function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE" => Iblock\PropertyTable::TYPE_ELEMENT,
			"USER_TYPE" => self::USER_TYPE,
			"DESCRIPTION" => getMessage("IBLOCK_PROP_ELIST_DESC"),
			"GetPropertyFieldHtml" => array(__CLASS__, "GetPropertyFieldHtml"),
			"GetPropertyFieldHtmlMulty" => array(__CLASS__, "GetPropertyFieldHtmlMulty"),
			"GetPublicEditHTML" => array(__CLASS__, "GetPropertyFieldHtml"),
			"GetPublicEditHTMLMulty" => array(__CLASS__, "GetPropertyFieldHtmlMulty"),
			"GetPublicViewHTML" => array(__CLASS__,  "GetPublicViewHTML"),
			"GetAdminFilterHTML" => array(__CLASS__, "GetAdminFilterHTML"),
			"PrepareSettings" =>array(__CLASS__, "PrepareSettings"),
			"GetSettingsHTML" =>array(__CLASS__, "GetSettingsHTML"),
			"GetExtendedValue" => array(__CLASS__,  "GetExtendedValue"),
		);
	}

	public static function PrepareSettings($arProperty)
	{
		$size = 0;
		if(is_array($arProperty["USER_TYPE_SETTINGS"]))
			$size = intval($arProperty["USER_TYPE_SETTINGS"]["size"]);
		if($size <= 0)
			$size = 1;

		$width = 0;
		if(is_array($arProperty["USER_TYPE_SETTINGS"]))
			$width = intval($arProperty["USER_TYPE_SETTINGS"]["width"]);
		if($width <= 0)
			$width = 0;

		if(is_array($arProperty["USER_TYPE_SETTINGS"]) && $arProperty["USER_TYPE_SETTINGS"]["group"] === "Y")
			$group = "Y";
		else
			$group = "N";

		if(is_array($arProperty["USER_TYPE_SETTINGS"]) && $arProperty["USER_TYPE_SETTINGS"]["multiple"] === "Y")
			$multiple = "Y";
		else
			$multiple = "N";

		return array(
			"size" =>  $size,
			"width" => $width,
			"group" => $group,
			"multiple" => $multiple,
		);
	}


	public static function GetPublicViewHTML($arProperty, $arValue, $strHTMLControlName)
	{
		static $cache = array();

		$strResult = '';
		$arValue['VALUE'] = intval($arValue['VALUE']);
		if (0 < $arValue['VALUE'])
		{
			if (!isset($cache[$arValue['VALUE']]))
			{
				$arFilter = array();
				$intIBlockID = intval($arProperty['LINK_IBLOCK_ID']);
				if (0 < $intIBlockID) $arFilter['IBLOCK_ID'] = $intIBlockID;
				$arFilter['ID'] = $arValue['VALUE'];
				$arFilter["ACTIVE"] = "Y";
				$arFilter["ACTIVE_DATE"] = "Y";
				$arFilter["CHECK_PERMISSIONS"] = "Y";
				$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID","IBLOCK_ID","NAME","DETAIL_PAGE_URL"));
				$cache[$arValue['VALUE']] = $rsElements->GetNext(true,false);
			}
			if (is_array($cache[$arValue['VALUE']]))
			{
				if (isset($strHTMLControlName['MODE']) && 'CSV_EXPORT' == $strHTMLControlName['MODE'])
				{
					$strResult = $cache[$arValue['VALUE']]['ID'];
				}
				elseif (isset($strHTMLControlName['MODE']) && ('SIMPLE_TEXT' == $strHTMLControlName['MODE'] || 'ELEMENT_TEMPLATE' == $strHTMLControlName['MODE']))
				{
					$strResult = $cache[$arValue['VALUE']]["NAME"];
				}
				else
				{
					$strResult = '<a href="'.$cache[$arValue['VALUE']]["DETAIL_PAGE_URL"].'">'.$cache[$arValue['VALUE']]["NAME"].'</a>';;
				}
			}
		}
		return $strResult;
	}


	/**
	 * Returns data for smart filter.
	 *
	 * @param array $arProperty				Property description.
	 * @param array $value					Current value.
	 * @return false|array
	 */
	public static function GetExtendedValue($arProperty, $value)
	{
		$html = self::GetPublicViewHTML($arProperty, $value, array('MODE' => 'SIMPLE_TEXT'));
		if (strlen($html))
		{
			$text = htmlspecialcharsback($html);
			return array(
				'VALUE' => $text,
				'UF_XML_ID' => $text,
			);
		}
		return false;
	}

	public static function GetElements($IBLOCK_ID)
	{
		static $cache = array();
		$IBLOCK_ID = intval($IBLOCK_ID);

		if(!array_key_exists($IBLOCK_ID, $cache))
		{
			$cache[$IBLOCK_ID] = array();
			if($IBLOCK_ID > 0)
			{
				$arSelect = array(
					"ID",
					"NAME",
					"IN_SECTIONS",
					"IBLOCK_SECTION_ID",
				);
				$arFilter = array (
					"IBLOCK_ID"=> $IBLOCK_ID,
					//"ACTIVE" => "Y",
					"CHECK_PERMISSIONS" => "Y",
				);
				$arOrder = array(
					"NAME" => "ASC",
					"ID" => "ASC",
				);
				$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
				while($arItem = $rsItems->GetNext())
					$cache[$IBLOCK_ID][] = $arItem;
			}
		}
		return $cache[$IBLOCK_ID];
	}

	public static function GetSections($IBLOCK_ID)
	{
		static $cache = array();
		$IBLOCK_ID = intval($IBLOCK_ID);

		if(!array_key_exists($IBLOCK_ID, $cache))
		{
			$cache[$IBLOCK_ID] = array();
			if($IBLOCK_ID > 0)
			{
				$arSelect = array(
					"ID",
					"NAME",
					"DEPTH_LEVEL",
				);
				$arFilter = array (
					"IBLOCK_ID"=> $IBLOCK_ID,
					//"ACTIVE" => "Y",
					"CHECK_PERMISSIONS" => "Y",
				);
				$arOrder = array(
					"LEFT_MARGIN" => "ASC",
				);
				$rsItems = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
				while($arItem = $rsItems->GetNext())
					$cache[$IBLOCK_ID][$arItem["ID"]] = $arItem;
			}
		}
		return $cache[$IBLOCK_ID];
	}
}