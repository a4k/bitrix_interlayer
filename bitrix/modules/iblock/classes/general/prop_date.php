<?php
use Bitrix\Iblock;


class CIBlockPropertyDate extends CIBlockPropertyDateTime
{
	const USER_TYPE = 'Date';

	public static function GetUserTypeDescription()
	{
	    return array(
			"PROPERTY_TYPE" => Iblock\PropertyTable::TYPE_STRING,
            "USER_TYPE" => self::USER_TYPE,
            "DESCRIPTION" => getMessage("IBLOCK_PROP_DATE_DESC"),
            //optional handlers
            "GetPublicViewHTML" => array(__CLASS__, "GetPublicViewHTML"),
            "GetPublicEditHTML" => array(__CLASS__, "GetPublicEditHTML"),
            "GetAdminListViewHTML" => array(__CLASS__, "GetAdminListViewHTML"),
            "GetPropertyFieldHtml" => array(__CLASS__, "GetPropertyFieldHtml"),
            "CheckFields" => array(__CLASS__, "CheckFields"),
            "ConvertToDB" => array(__CLASS__, "ConvertToDB"),
            "ConvertFromDB" => array(__CLASS__, "ConvertFromDB"),
            "GetSettingsHTML" => array(__CLASS__, "GetSettingsHTML"),
            "GetAdminFilterHTML" => array(__CLASS__, "GetAdminFilterHTML"),
            "GetPublicFilterHTML" => array(__CLASS__, "GetPublicFilterHTML"),
            "AddFilterFields" => array(__CLASS__, "AddFilterFields"),
        );
	}

	public static function ConvertToDB($arProperty, $value)
	{
		if (strlen($value["VALUE"])>0)
			$value["VALUE"] = CDatabase::FormatDate($value["VALUE"], CLang::GetDateFormat("SHORT"), "YYYY-MM-DD");

		return $value;
	}

	public static function ConvertFromDB($arProperty, $value, $format = '')
	{
		if(strlen($value["VALUE"])>0)
			$value["VALUE"] = CDatabase::FormatDate($value["VALUE"], "YYYY-MM-DD", CLang::GetDateFormat("SHORT"));

		return $value;
	}


}