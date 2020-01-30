<?
use Bitrix\Main\Type\Date,
	Bitrix\Iblock;


class CIBlockPropertyDateTime
{
	const USER_TYPE = 'DateTime';

	public static function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE" => Iblock\PropertyTable::TYPE_STRING,
			"USER_TYPE" => self::USER_TYPE,
			"DESCRIPTION" => getMessage("IBLOCK_PROP_DATETIME_DESC"),
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

	public static function AddFilterFields($arProperty, $strHTMLControlName, &$arFilter, &$filtered)
	{
		$filtered = false;

		//TODO: remove this condition after main 17.0.0 will be stable
		$existFilterOptions = class_exists('\Bitrix\Main\UI\Filter\Options') && method_exists('\Bitrix\Main\UI\Filter\Options', 'getFilter');

		$from = "";
		$from_name = $strHTMLControlName["VALUE"].'_from';
		if(isset($_REQUEST[$from_name]))
		{
			$from = $_REQUEST[$from_name];
		}
		elseif(isset($strHTMLControlName["GRID_ID"]) &&
			isset($_SESSION["main.interface.grid"][$strHTMLControlName["GRID_ID"]]["filter"][$from_name]))
		{
			$from = $_SESSION["main.interface.grid"][$strHTMLControlName["GRID_ID"]]["filter"][$from_name];
		}
		elseif($existFilterOptions && isset($strHTMLControlName["FILTER_ID"]))
		{
			$filterOption = new \Bitrix\Main\UI\Filter\Options($strHTMLControlName["FILTER_ID"]);
			$filterData = $filterOption->getFilter();
			$from = !empty($filterData[$from_name]) ? $filterData[$from_name] : "";
		}

		if($from)
		{
			if(CheckDateTime($from))
			{
				$from = static::ConvertToDB($arProperty, array("VALUE"=>$from));
				$arFilter[">=PROPERTY_".$arProperty["ID"]] = $from["VALUE"];
				$filtered = true;
			}
			else
			{
				$arFilter[">=PROPERTY_".$arProperty["ID"]] = $from;
				$filtered = true;
			}
		}

		$to = "";
		$to_name = $strHTMLControlName["VALUE"].'_to';
		if(isset($_REQUEST[$to_name]))
		{
			$to = $_REQUEST[$to_name];
		}
		elseif(isset($strHTMLControlName["GRID_ID"]) &&
			isset($_SESSION["main.interface.grid"][$strHTMLControlName["GRID_ID"]]["filter"][$to_name]))
		{
			$to = $_SESSION["main.interface.grid"][$strHTMLControlName["GRID_ID"]]["filter"][$to_name];
		}
		elseif($existFilterOptions && isset($strHTMLControlName["FILTER_ID"]))
		{
			$filterOption = new \Bitrix\Main\UI\Filter\Options($strHTMLControlName["FILTER_ID"]);
			$filterData = $filterOption->getFilter();
			$to = !empty($filterData[$to_name]) ? $filterData[$to_name] : "";
			if($to)
			{
				$dateFormat = Date::convertFormatToPhp(CSite::getDateFormat());
				$dateParse = date_parse_from_format($dateFormat, $to);
				if(!strlen($dateParse["hour"]) && !strlen($dateParse["minute"]) && !strlen($dateParse["second"]))
				{
					$timeFormat = Date::convertFormatToPhp(CSite::getTimeFormat());
					$to .= " ".date($timeFormat, mktime(23, 59, 59, 0, 0, 0));
				}
			}
		}

		if($to)
		{
			if(CheckDateTime($to))
			{
				$to = static::ConvertToDB($arProperty, array("VALUE"=>$to));
				$arFilter["<=PROPERTY_".$arProperty["ID"]] = $to["VALUE"];
				$filtered = true;
			}
			else
			{
				$arFilter["<=PROPERTY_".$arProperty["ID"]] = $to;
				$filtered = true;
			}
		}
	}


	//PARAMETERS:
	//$arProperty - b_iblock_property.*
	//$value - array("VALUE",["DESCRIPTION"]) -- here comes HTML form value
	//return:
	//array of error messages
	public static function CheckFields($arProperty, $value)
	{
		$arResult = array();
		if(strlen($value["VALUE"])>0 && !CheckDateTime($value["VALUE"]))
			$arResult[] = GetMessage("IBLOCK_PROP_DATETIME_ERROR_NEW", array("#FIELD_NAME#" => $arProperty["NAME"]));
		return $arResult;
	}

	//PARAMETERS:
	//$arProperty - b_iblock_property.*
	//$value - array("VALUE",["DESCRIPTION"]) -- here comes HTML form value
	//return:
	//DB form of the value
	public static function ConvertToDB($arProperty, $value)
	{
		if (strlen($value["VALUE"]) > 0)
		{
			try
			{
				$time = Bitrix\Main\Type\DateTime::createFromUserTime($value['VALUE']);

				$value['VALUE'] = $time->format("Y-m-d H:i:s");
			}
			catch(Bitrix\Main\ObjectException $e)
			{
			}
		}

		return $value;
	}

	public static function ConvertFromDB($arProperty, $value, $format = '')
	{
		if (strlen($value["VALUE"]) > 0)
		{
			try
			{
				$time = new Bitrix\Main\Type\DateTime($value['VALUE'], "Y-m-d H:i:s");
				$time->toUserTime();

				if ($format === 'SHORT')
					$phpFormat = $time->convertFormatToPhp(FORMAT_DATE);
				elseif ($format === 'FULL')
					$phpFormat = $time->convertFormatToPhp(FORMAT_DATETIME);
				elseif ($format)
					$phpFormat = $time->convertFormatToPhp($format);
				else
					$phpFormat = $time->getFormat();

				$value["VALUE"] = $time->format($phpFormat);
				$value["VALUE"] = str_replace(" 00:00:00", "", $value["VALUE"]);
			}
			catch(Bitrix\Main\ObjectException $e)
			{
			}
		}

		return $value;
	}

}