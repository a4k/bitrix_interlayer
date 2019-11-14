<?
use Bitrix\Main\Loader,
	Bitrix\Iblock;


class CIBlockPropertyHTML
{
	const USER_TYPE = 'HTML';

	public static function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE" => Iblock\PropertyTable::TYPE_STRING,
			"USER_TYPE" => self::USER_TYPE,
			"DESCRIPTION" => getMessage("IBLOCK_PROP_HTML_DESC"),
			"GetPublicViewHTML" => array(__CLASS__, "GetPublicViewHTML"),
			"GetPublicEditHTML" => array(__CLASS__, "GetPublicEditHTML"),
			"GetAdminListViewHTML" => array(__CLASS__, "GetAdminListViewHTML"),
			"GetPropertyFieldHtml" => array(__CLASS__, "GetPropertyFieldHtml"),
			"ConvertToDB" => array(__CLASS__, "ConvertToDB"),
			"ConvertFromDB" => array(__CLASS__, "ConvertFromDB"),
			"GetLength" =>array(__CLASS__, "GetLength"),
			"PrepareSettings" =>array(__CLASS__, "PrepareSettings"),
			"GetSettingsHTML" =>array(__CLASS__, "GetSettingsHTML"),
			"GetUIFilterProperty" => array(__CLASS__, "GetUIFilterProperty")
		);
	}

	public static function GetPublicViewHTML($arProperty, $value, $strHTMLControlName)
	{
		if (!is_array($value["VALUE"]))
			$value = static::ConvertFromDB($arProperty, $value);
		$ar = $value["VALUE"];
		if (!empty($ar) && is_array($ar))
		{
			if (isset($strHTMLControlName['MODE']) && $strHTMLControlName['MODE'] == 'CSV_EXPORT')
				return '['.$ar["TYPE"].']'.$ar["TEXT"];
			elseif (isset($strHTMLControlName['MODE']) && $strHTMLControlName['MODE'] == 'SIMPLE_TEXT')
				return ($ar["TYPE"] == 'HTML' ? strip_tags($ar["TEXT"]) : $ar["TEXT"]);
			else
				return FormatText($ar["TEXT"], $ar["TYPE"]);
		}

		return '';
	}

	public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
	{
		$strHTMLControlName["VALUE"] = htmlspecialcharsEx($strHTMLControlName["VALUE"]);
		if (!is_array($value["VALUE"]))
			$value = static::ConvertFromDB($arProperty, $value);
		$ar = $value["VALUE"];
		if (strtolower($ar["TYPE"]) != "text")
			$ar["TYPE"] = "html";
		else
			$ar["TYPE"] = "text";

		$settings = static::PrepareSettings($arProperty);

		ob_start();
		?><table width="100%"><?
		if($strHTMLControlName["MODE"]=="FORM_FILL" && COption::GetOptionString("iblock", "use_htmledit", "Y")=="Y" && Loader::includeModule("fileman")):
		?><tr>
			<td colspan="2" align="center">
			<input type="hidden" name="<?=$strHTMLControlName["VALUE"]?>" value="">
				<?
				$text_name = preg_replace("/([^a-z0-9])/is", "_", $strHTMLControlName["VALUE"]."[TEXT]");
				$text_type = preg_replace("/([^a-z0-9])/is", "_", $strHTMLControlName["VALUE"]."[TYPE]");
				CFileMan::AddHTMLEditorFrame($text_name, htmlspecialcharsBx($ar["TEXT"]), $text_type, strtolower($ar["TYPE"]), $settings['height'], "N", 0, "", "");
				?>
			</td>
		</tr>
		<?else:?>
		<tr>
			<td align="right"><?echo getMessage("IBLOCK_DESC_TYPE")?></td>
			<td align="left">
				<input type="radio" name="<?=$strHTMLControlName["VALUE"]?>[TYPE]" id="<?=$strHTMLControlName["VALUE"]?>[TYPE][TEXT]" value="text" <?if($ar["TYPE"]!="html")echo " checked"?>>
				<label for="<?=$strHTMLControlName["VALUE"]?>[TYPE][TEXT]"><?echo getMessage("IBLOCK_DESC_TYPE_TEXT")?></label> /
				<input type="radio" name="<?=$strHTMLControlName["VALUE"]?>[TYPE]" id="<?=$strHTMLControlName["VALUE"]?>[TYPE][HTML]" value="html"<?if($ar["TYPE"]=="html")echo " checked"?>>
				<label for="<?=$strHTMLControlName["VALUE"]?>[TYPE][HTML]"><?echo getMessage("IBLOCK_DESC_TYPE_HTML")?></label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><textarea cols="60" rows="10" name="<?=$strHTMLControlName["VALUE"]?>[TEXT]" style="width:100%"><?=htmlspecialcharsEx($ar["TEXT"])?></textarea></td>
		</tr>
		<?endif;
		if (($arProperty["WITH_DESCRIPTION"]=="Y") && ('' != trim($strHTMLControlName["DESCRIPTION"]))):?>
		<tr>
			<td colspan="2">
				<span title="<?echo getMessage("IBLOCK_PROP_HTML_DESCRIPTION_TITLE")?>"><?echo getMessage("IBLOCK_PROP_HTML_DESCRIPTION_LABEL")?>:<input type="text" name="<?=$strHTMLControlName["DESCRIPTION"]?>" value="<?=$value["DESCRIPTION"]?>" size="18"></span>
			</td>
		</tr>
		<?endif;?>
		</table>
		<?
		$return = ob_get_contents();
		ob_end_clean();
		return  $return;
	}

	public static function ConvertToDB($arProperty, $value)
	{
		global $DB;
		$return = false;

		if (!is_array($value))
		{
			$value = static::getValueFromString($value, true);
		}
		elseif (isset($value['VALUE']) && !is_array($value['VALUE']))
		{
			$value['VALUE'] = static::getValueFromString($value['VALUE'], false);
		}
		$defaultValue = isset($value['DEFAULT_VALUE']) && $value['DEFAULT_VALUE'] === true;

		if(
			is_array($value)
			&& array_key_exists("VALUE", $value)
		)
		{
			$text = trim($value["VALUE"]["TEXT"]);
			$len = strlen($text);
			if ($len > 0 || $defaultValue)
			{
				if ($DB->type === "MYSQL")
					$limit = 63200;
				else
					$limit = 1950;

				if ($len > $limit)
					$value["VALUE"]["TEXT"] = substr($text, 0, $limit);

				$val = static::CheckArray($value["VALUE"], $defaultValue);
				if (is_array($val))
				{
					$return = array(
						"VALUE" => serialize($val),
					);
					if (trim($value["DESCRIPTION"]) != '')
						$return["DESCRIPTION"] = trim($value["DESCRIPTION"]);
				}
			}
		}

		return $return;
	}

	public static function ConvertFromDB($arProperty, $value)
	{
		$return = false;
		if (!is_array($value["VALUE"]))
		{
			$return = array(
				"VALUE" => unserialize($value["VALUE"]),
			);
			if ($return['VALUE'] === false && strlen($value['VALUE']) > 0)
			{
				$return = array(
					"VALUE" => array(
						'TEXT' => $value["VALUE"],
						'TYPE' => 'TEXT'
					)
				);
			}
			if($value["DESCRIPTION"])
				$return["DESCRIPTION"] = trim($value["DESCRIPTION"]);
		}
		return $return;
	}

	/**
	 * Check value.
	 *
	 * @param bool|array $arFields			Current value.
	 * @param bool $defaultValue			Is default value.
	 * @return array|bool
	 */
	public static function CheckArray($arFields = false, $defaultValue = false)
	{
		$defaultValue = ($defaultValue === true);
		if (!is_array($arFields))
		{
			$return = false;
			if (CheckSerializedData($arFields))
				$return = unserialize($arFields);
		}
		else
		{
			$return = $arFields;
		}

		if ($return)
		{
			if (is_set($return, "TEXT") && ((strlen(trim($return["TEXT"])) > 0) || $defaultValue))
			{
				$return["TYPE"] = strtoupper($return["TYPE"]);
				if (($return["TYPE"] != "TEXT") && ($return["TYPE"] != "HTML"))
					$return["TYPE"] = "HTML";
			}
			else
			{
				$return = false;
			}
		}
		return $return;
	}

	public static function GetLength($arProperty, $value)
	{
		if(is_array($value) && isset($value["VALUE"]["TEXT"]))
			return strlen(trim($value["VALUE"]["TEXT"]));
		else
			return 0;
	}

	public static function PrepareSettings($arProperty)
	{
		$height = 0;
		if (isset($arProperty["USER_TYPE_SETTINGS"]["height"]))
			$height = (int)$arProperty["USER_TYPE_SETTINGS"]["height"];
		if ($height <= 0)
			$height = 200;

		return array(
			"height" =>  $height,
		);
	}

	public static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
	{
		$arPropertyFields = array(
			"HIDE" => array("ROW_COUNT", "COL_COUNT"),
		);

		$height = 0;
		if (isset($arProperty["USER_TYPE_SETTINGS"]["height"]))
			$height = (int)$arProperty["USER_TYPE_SETTINGS"]["height"];
		if($height <= 0)
			$height = 200;

		return '
		<tr valign="top">
			<td>'.getMessage("IBLOCK_PROP_HTML_SETTING_HEIGHT").':</td>
			<td><input type="text" size="5" name="'.$strHTMLControlName["NAME"].'[height]" value="'.$height.'">px</td>
		</tr>
		';
	}

	/**
	 * @param array $property
	 * @param array $strHTMLControlName
	 * @param array &$fields
	 * @return void
	 */
	public static function GetUIFilterProperty($property, $strHTMLControlName, &$fields)
	{
		$fields["type"] = "string";
		$fields["filterable"] = "?";
	}

	protected static function getValueFromString($value, $getFull = false)
	{
		$getFull = ($getFull === true);
		$valueType = 'HTML';
		$value = (string)$value;
		if ($value !== '')
		{
			$prefix = strtoupper(substr($value, 0, 6));
			$isText = $prefix == '[TEXT]';
			if ($prefix == '[HTML]' || $isText)
			{
				if ($isText)
					$valueType = 'TEXT';
				$value = substr($value, 6);
			}
		}
		if ($getFull)
		{
			return array(
				'VALUE' => array(
					'TEXT' => $value,
					'TYPE' => $valueType
				)
			);
		}
		else
		{
			return array(
				'TEXT' => $value,
				'TYPE' => $valueType
			);
		}
	}
}