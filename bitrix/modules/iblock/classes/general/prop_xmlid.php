<?
use Bitrix\Iblock;

class CIBlockPropertyXmlID
{
	const USER_TYPE = 'ElementXmlID';

	public static function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE" => Iblock\PropertyTable::TYPE_STRING,
			"USER_TYPE" => self::USER_TYPE,
			"DESCRIPTION" => getMessage("IBLOCK_PROP_XMLID_DESC"),
			"GetPublicViewHTML" => array(__CLASS__, "GetPublicViewHTML"),
			"GetAdminListViewHTML" => array(__CLASS__, "GetAdminListViewHTML"),
			"GetPropertyFieldHtml" => array(__CLASS__, "GetPropertyFieldHtml"),
			"GetSettingsHTML" => array(__CLASS__, "GetSettingsHTML"),
		);
	}

}