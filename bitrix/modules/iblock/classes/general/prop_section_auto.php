<?
use Bitrix\Iblock;

class CIBlockPropertySectionAutoComplete extends CIBlockPropertyElementAutoComplete
{
	const USER_TYPE = 'SectionAuto';

	public static function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE" => Iblock\PropertyTable::TYPE_SECTION,
			"USER_TYPE" => self::USER_TYPE,
			"DESCRIPTION" => getMessage('BT_UT_SAUTOCOMPLETE_DESCR'),
			"GetPropertyFieldHtml" => array(__CLASS__, "GetPropertyFieldHtml"),
			"GetPropertyFieldHtmlMulty" => array(__CLASS__,'GetPropertyFieldHtmlMulty'),
			"GetAdminListViewHTML" => array(__CLASS__,"GetAdminListViewHTML"),
			"GetPublicViewHTML" => array(__CLASS__, "GetPublicViewHTML"),
			"GetPublicEditHTML" => array(__CLASS__, "GetPublicEditHTML"),
			"GetAdminFilterHTML" => array(__CLASS__,'GetAdminFilterHTML'),
			"GetSettingsHTML" => array(__CLASS__,'GetSettingsHTML'),
			"PrepareSettings" => array(__CLASS__,'PrepareSettings'),
			"AddFilterFields" => array(__CLASS__,'AddFilterFields'),
		);
	}

	public static function GetValueForAutoComplete($arProperty,$arValue,$arBanSym="",$arRepSym="")
	{
		$strResult = '';
		$mxResult = static::GetPropertyValue($arProperty,$arValue);
		if (is_array($mxResult))
		{
			$strResult = htmlspecialcharsbx(str_replace($arBanSym,$arRepSym,$mxResult['~NAME'])).' ['.$mxResult['ID'].']';
		}
		return $strResult;
	}

	public static function GetValueForAutoCompleteMulti($arProperty,$arValues,$arBanSym="",$arRepSym="")
	{
		$arResult = false;

		if (is_array($arValues))
		{
			foreach ($arValues as $intPropertyValueID => $arOneValue)
			{
				if (!is_array($arOneValue))
				{
					$strTmp = $arOneValue;
					$arOneValue = array(
						'VALUE' => $strTmp,
					);
				}
				$mxResult = static::GetPropertyValue($arProperty,$arOneValue);
				if (is_array($mxResult))
				{
					$arResult[$intPropertyValueID] = htmlspecialcharsbx(str_replace($arBanSym,$arRepSym,$mxResult['~NAME'])).' ['.$mxResult['ID'].']';
				}
			}
		}
		return $arResult;
	}


	public static function PrepareSettings($arFields)
	{
		/*
		 * VIEW				- view type
		 * SHOW_ADD			- show button for add new values in linked iblock
		 * MAX_WIDTH		- max width textarea and input in pixels
		 * MIN_HEIGHT		- min height textarea in pixels
		 * MAX_HEIGHT		- max height textarea in pixels
		 * BAN_SYM			- banned symbols string
		 * REP_SYM			- replace symbol
		 * OTHER_REP_SYM	- non standart replace symbol
		 * IBLOCK_MESS		- get lang mess from linked iblock
		 */
		$arViewsList = static::GetPropertyViewsList(false);
		$strView = (isset($arFields['USER_TYPE_SETTINGS']['VIEW']) && in_array($arFields['USER_TYPE_SETTINGS']['VIEW'],$arViewsList) ? $arFields['USER_TYPE_SETTINGS']['VIEW'] : current($arViewsList));

		$strShowAdd = (isset($arFields['USER_TYPE_SETTINGS']['SHOW_ADD']) ? $arFields['USER_TYPE_SETTINGS']['SHOW_ADD'] : '');
		$strShowAdd = ('Y' == $strShowAdd ? 'Y' : 'N');
		if ((int)$arFields['LINK_IBLOCK_ID'] <= 0)
			$strShowAdd = 'N';

		$intMaxWidth = intval(isset($arFields['USER_TYPE_SETTINGS']['MAX_WIDTH']) ? $arFields['USER_TYPE_SETTINGS']['MAX_WIDTH'] : 0);
		if (0 >= $intMaxWidth) $intMaxWidth = 0;

		$intMinHeight = intval(isset($arFields['USER_TYPE_SETTINGS']['MIN_HEIGHT']) ? $arFields['USER_TYPE_SETTINGS']['MIN_HEIGHT'] : 0);
		if (0 >= $intMinHeight) $intMinHeight = 24;

		$intMaxHeight = intval(isset($arFields['USER_TYPE_SETTINGS']['MAX_HEIGHT']) ? $arFields['USER_TYPE_SETTINGS']['MAX_HEIGHT'] : 0);
		if (0 >= $intMaxHeight) $intMaxHeight = 1000;

		$strBannedSymbols = trim(isset($arFields['USER_TYPE_SETTINGS']['BAN_SYM']) ? $arFields['USER_TYPE_SETTINGS']['BAN_SYM'] : ',;');
		$strBannedSymbols = str_replace(' ','',$strBannedSymbols);
		if (false === strpos($strBannedSymbols,','))
			$strBannedSymbols .= ',';
		if (false === strpos($strBannedSymbols,';'))
			$strBannedSymbols .= ';';

		$strOtherReplaceSymbol = '';
		$strReplaceSymbol = (isset($arFields['USER_TYPE_SETTINGS']['REP_SYM']) ? $arFields['USER_TYPE_SETTINGS']['REP_SYM'] : ' ');
		if (BT_UT_AUTOCOMPLETE_REP_SYM_OTHER == $strReplaceSymbol)
		{
			$strOtherReplaceSymbol = (isset($arFields['USER_TYPE_SETTINGS']['OTHER_REP_SYM']) ? substr($arFields['USER_TYPE_SETTINGS']['OTHER_REP_SYM'],0,1) : '');
			if ((',' == $strOtherReplaceSymbol) || (';' == $strOtherReplaceSymbol))
				$strOtherReplaceSymbol = '';
			if (('' == $strOtherReplaceSymbol) || in_array($strOtherReplaceSymbol,static::GetReplaceSymList()))
			{
				$strReplaceSymbol = $strOtherReplaceSymbol;
				$strOtherReplaceSymbol = '';
			}
		}
		if ('' == $strReplaceSymbol)
		{
			$strReplaceSymbol = ' ';
			$strOtherReplaceSymbol = '';
		}

		$strIBlockMess = (isset($arFields['USER_TYPE_SETTINGS']['IBLOCK_MESS']) ? $arFields['USER_TYPE_SETTINGS']['IBLOCK_MESS'] : '');
		if ('Y' != $strIBlockMess) $strIBlockMess = 'N';

		return array(
			'VIEW' => $strView,
			'SHOW_ADD' => $strShowAdd,
			'MAX_WIDTH' => $intMaxWidth,
			'MIN_HEIGHT' => $intMinHeight,
			'MAX_HEIGHT' => $intMaxHeight,
			'BAN_SYM' => $strBannedSymbols,
			'REP_SYM' => $strReplaceSymbol,
			'OTHER_REP_SYM' => $strOtherReplaceSymbol,
			'IBLOCK_MESS' => $strIBlockMess,
		);
	}


	public static function AddFilterFields($arProperty, $strHTMLControlName, &$arFilter, &$filtered)
	{
		$filtered = false;

		$arFilterValues = array();

		if (isset($_REQUEST[$strHTMLControlName["VALUE"]]) && (is_array($_REQUEST[$strHTMLControlName["VALUE"]]) || (0 < intval($_REQUEST[$strHTMLControlName["VALUE"]]))))
		{
			$arFilterValues = (is_array($_REQUEST[$strHTMLControlName["VALUE"]]) ? $_REQUEST[$strHTMLControlName["VALUE"]] : array($_REQUEST[$strHTMLControlName["VALUE"]]));
		}
		elseif (isset($GLOBALS[$strHTMLControlName["VALUE"]]) && (is_array($GLOBALS[$strHTMLControlName["VALUE"]]) || (0 < intval($GLOBALS[$strHTMLControlName["VALUE"]]))))
		{
			$arFilterValues = (is_array($GLOBALS[$strHTMLControlName["VALUE"]]) ? $GLOBALS[$strHTMLControlName["VALUE"]] : array($GLOBALS[$strHTMLControlName["VALUE"]]));
		}

		foreach ($arFilterValues as $key => $value)
		{
			if (0 >= intval($value))
				unset($arFilterValues[$key]);
		}

		if (!empty($arFilterValues))
		{
			$arFilter["=PROPERTY_".$arProperty["ID"]] = $arFilterValues;
			$filtered = true;
		}
	}

	protected static function GetLinkElement($sectionID,$iblockID)
	{
		static $cache = array();

		$iblockID = intval($iblockID);
		if (0 >= $iblockID)
			$iblockID = 0;
		$sectionID = intval($sectionID);
		if (0 >= $sectionID)
			return false;
		if (!isset($cache[$sectionID]))
		{
			$arFilter = array();
			if (0 < $iblockID)
				$arFilter['IBLOCK_ID'] = $iblockID;
			$arFilter['ID'] = $sectionID;
			$sectionRes = CIBlockSection::GetList(array(),$arFilter,false,array('IBLOCK_ID','ID','NAME'));
			if ($section = $sectionRes->GetNext(true,true))
			{
				$result = array(
					'ID' => $section['ID'],
					'NAME' => $section['NAME'],
					'~NAME' => $section['~NAME'],
					'IBLOCK_ID' => $section['IBLOCK_ID'],
				);
				$cache[$sectionID] = $result;
			}
			else
			{
				$cache[$sectionID] = false;
			}
		}
		return $cache[$sectionID];
	}

	protected static function GetPropertyValue($arProperty,$arValue)
	{
		$mxResult = false;

		if (0 < intval($arValue['VALUE']))
		{
			$mxResult = static::GetLinkElement($arValue['VALUE'],$arProperty['LINK_IBLOCK_ID']);
			if (is_array($mxResult))
			{
				$mxResult['PROPERTY_ID'] = $arProperty['ID'];
				if (isset($arProperty['PROPERTY_VALUE_ID']))
				{
					$mxResult['PROPERTY_VALUE_ID'] = $arProperty['PROPERTY_VALUE_ID'];
				}
				else
				{
					$mxResult['PROPERTY_VALUE_ID'] = false;
				}
			}
		}
		return $mxResult;
	}

	protected static function GetPropertyViewsList($boolFull)
	{
		$boolFull = (true == $boolFull);
		if ($boolFull)
		{
			return array(
				'REFERENCE' => array(
					getMessage('BT_UT_SAUTOCOMPLETE_VIEW_AUTO'),
					getMessage('BT_UT_SAUTOCOMPLETE_VIEW_ELEMENT'),
				),
				'REFERENCE_ID' => array(
					'A','E'
				),
			);
		}
		return array('A','E');
	}

	protected static function GetReplaceSymList($boolFull = false)
	{
		$boolFull = (true == $boolFull);
		if ($boolFull)
		{
			return array(
				'REFERENCE' => array(
					getMessage('BT_UT_AUTOCOMPLETE_SYM_SPACE'),
					getMessage('BT_UT_AUTOCOMPLETE_SYM_GRID'),
					getMessage('BT_UT_AUTOCOMPLETE_SYM_STAR'),
					getMessage('BT_UT_AUTOCOMPLETE_SYM_UNDERLINE'),
					getMessage('BT_UT_AUTOCOMPLETE_SYM_OTHER'),

				),
				'REFERENCE_ID' => array(
					' ',
					'#',
					'*',
					'_',
					BT_UT_AUTOCOMPLETE_REP_SYM_OTHER,
				),
			);
		}
		return array(' ', '#', '*','_');
	}

	protected static function GetSymbols($arSettings)
	{
		$strBanSym = $arSettings['BAN_SYM'];
		$strRepSym = (BT_UT_AUTOCOMPLETE_REP_SYM_OTHER == $arSettings['REP_SYM'] ? $arSettings['OTHER_REP_SYM'] : $arSettings['REP_SYM']);
		$arBanSym = str_split($strBanSym,1);
		$arRepSym = array_fill(0,sizeof($arBanSym),$strRepSym);
		$arResult = array(
			'BAN_SYM' => $arBanSym,
			'REP_SYM' => array_fill(0,sizeof($arBanSym),$strRepSym),
			'BAN_SYM_STRING' => $strBanSym,
			'REP_SYM_STRING' => $strRepSym,
		);
		return $arResult;
	}
}

define ('BT_UT_SECTION_AUTOCOMPLETE_CODE', CIBlockPropertySectionAutoComplete::USER_TYPE); // deprecated