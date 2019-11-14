<?
use Bitrix\Iblock;

class CIBlockPropertySequence
{
	const USER_TYPE = 'Sequence';

	public static function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE" => Iblock\PropertyTable::TYPE_NUMBER,
			"USER_TYPE" => self::USER_TYPE,
			"DESCRIPTION" => getMessage("IBLOCK_PROP_SEQUENCE_DESC"),
			"GetPropertyFieldHtml" => array(__CLASS__, "GetPropertyFieldHtml"),
			"GetPublicEditHTML" => array(__CLASS__, "GetPropertyFieldHtml"),
			"PrepareSettings" =>array(__CLASS__, "PrepareSettings"),
			"GetSettingsHTML" =>array(__CLASS__, "GetSettingsHTML"),
			"GetAdminFilterHTML" => array(__CLASS__, "GetPublicFilterHTML"),
			"GetPublicFilterHTML" => array(__CLASS__, "GetPublicFilterHTML"),
			"AddFilterFields" => array(__CLASS__, "AddFilterFields"),
		);
	}

	public static function AddFilterFields($arProperty, $strHTMLControlName, &$arFilter, &$filtered)
	{
		$from_name = $strHTMLControlName["VALUE"].'_from';
		$from = isset($_REQUEST[$from_name])? $_REQUEST[$from_name]: "";
		if($from)
		{
			$arFilter[">=PROPERTY_".$arProperty["ID"]] = $from;
			$filtered = true;
		}

		$to_name = $strHTMLControlName["VALUE"].'_to';
		$to = isset($_REQUEST[$to_name])? $_REQUEST[$to_name]: "";
		if($to)
		{
			$arFilter["<=PROPERTY_".$arProperty["ID"]] = $to;
			$filtered = true;
		}
	}


	public static function PrepareSettings($arProperty)
	{
		//This method not for storing sequence value in the database
		//but it just sets starting value for it
		if(
			is_array($arProperty["USER_TYPE_SETTINGS"])
			&& isset($arProperty["USER_TYPE_SETTINGS"]["current_value"])
			&& intval($arProperty["USER_TYPE_SETTINGS"]["current_value"]) > 0
		)
		{
			$seq = new CIBlockSequence($arProperty["IBLOCK_ID"], $arProperty["ID"]);
			$seq->SetNext($arProperty["USER_TYPE_SETTINGS"]["current_value"]);
		}

		if(is_array($arProperty["USER_TYPE_SETTINGS"]) && $arProperty["USER_TYPE_SETTINGS"]["write"]==="Y")
			$strWritable = "Y";
		else
			$strWritable = "N";

		$arProperty['USER_TYPE_SETTINGS'] = array(
			"write" => $strWritable,
		);
		return $arProperty;
	}

}