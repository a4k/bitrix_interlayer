<?
class CIBlock extends CAllIBlock
{
    ///////////////////////////////////////////////////////////////////
	// List of blocks
	///////////////////////////////////////////////////////////////////
	public static function GetList($arOrder=Array("SORT"=>"ASC"), $arFilter=Array(), $bIncCnt = false)
	{
		global $DB, $USER;

		$strSqlSearch = "";
		$bAddSites = false;
		foreach($arFilter as $key => $val)
		{
			$res = CIBlock::MkOperationFilter($key);
			$key = strtoupper($res["FIELD"]);
			$cOperationType = $res["OPERATION"];

			switch($key)
			{
			case "ACTIVE":
				$sql = CIBlock::FilterCreate("B.ACTIVE", $val, "string_equal", $cOperationType);
				break;
			case "LID":
			case "SITE_ID":
				$sql = CIBlock::FilterCreate("BS.SITE_ID", $val, "string_equal", $cOperationType);
				if(strlen($sql))
					$bAddSites = true;
				break;
			case "NAME":
			case "CODE":
			case "XML_ID":
			case "PROPERTY_INDEX":
				$sql = CIBlock::FilterCreate("B.".$key, $val, "string", $cOperationType);
				break;
			case "EXTERNAL_ID":
				$sql = CIBlock::FilterCreate("B.XML_ID", $val, "string", $cOperationType);
				break;
			case "TYPE":
				$sql = CIBlock::FilterCreate("B.IBLOCK_TYPE_ID", $val, "string", $cOperationType);
				break;
			case "ID":
			case "VERSION":
			case "SOCNET_GROUP_ID":
				$sql = CIBlock::FilterCreate("B.".$key, $val, "number", $cOperationType);
				break;
			default:
				$sql = "";
				break;
			}

			if(strlen($sql))
				$strSqlSearch .= " AND  (".$sql.") ";
		}

		$bCheckPermissions =
			!array_key_exists("CHECK_PERMISSIONS", $arFilter)
			|| $arFilter["CHECK_PERMISSIONS"] !== "N"
			|| array_key_exists("OPERATION", $arFilter)
		;
		$bIsAdmin = is_object($USER) && $USER->IsAdmin();
		$permissionsBy = null;
		if ($bCheckPermissions && isset($arFilter['PERMISSIONS_BY']))
		{
			$permissionsBy = (int)$arFilter['PERMISSIONS_BY'];
			if ($permissionsBy < 0)
				$permissionsBy = null;
		}
        $sqlPermissions = "";

		if ($bAddSites)
			$sqlJoinSites = "LEFT JOIN b_iblock_site BS ON B.ID=BS.IBLOCK_ID
					LEFT JOIN b_lang L ON L.LID=BS.SITE_ID";
		else
			$sqlJoinSites = "INNER JOIN b_lang L ON L.LID=B.LID";

		if(!$bIncCnt)
		{
			$strSql = "
				SELECT DISTINCT
					B.*
					,B.XML_ID as EXTERNAL_ID
					,".$DB->DateToCharFunction("B.TIMESTAMP_X")." as TIMESTAMP_X
					,L.DIR as LANG_DIR
					,L.SERVER_NAME
				FROM
					b_iblock B
					".$sqlJoinSites."
				WHERE 1 = 1
					".$sqlPermissions."
					".$strSqlSearch."
			";
		}
		else
		{
			$strSql = "
				SELECT
					B.*
					,B.XML_ID as EXTERNAL_ID
					,".$DB->DateToCharFunction("B.TIMESTAMP_X")." as TIMESTAMP_X
					,L.DIR as LANG_DIR
					,L.SERVER_NAME
					,COUNT(DISTINCT BE.ID) as ELEMENT_CNT
				FROM
					b_iblock B
					".$sqlJoinSites."
					LEFT JOIN b_iblock_element BE ON (BE.IBLOCK_ID=B.ID
						AND (
							(BE.WF_STATUS_ID=1 AND BE.WF_PARENT_ELEMENT_ID IS NULL )
							".($arFilter["CNT_ALL"]=="Y"? " OR BE.WF_NEW='Y' ":"")."
						)
						".($arFilter["CNT_ACTIVE"]=="Y"?
						"AND BE.ACTIVE='Y'
						AND (BE.ACTIVE_TO >= ".$DB->CurrentDateFunction()." OR BE.ACTIVE_TO IS NULL)
						AND (BE.ACTIVE_FROM <= ".$DB->CurrentDateFunction()." OR BE.ACTIVE_FROM IS NULL)
						":
						"")."
					)
				WHERE 1 = 1
					".$sqlPermissions."
					".$strSqlSearch."
				GROUP BY B.ID
			";
		}

		$arSqlOrder = Array();
		if(is_array($arOrder))
		{
			foreach($arOrder as $by=>$order)
			{
				$by = strtolower($by);
				$order = strtolower($order);
				if ($order!="asc")
					$order = "desc";

				if ($by == "id") $arSqlOrder[$by] = " B.ID ".$order." ";
				elseif ($by == "lid") $arSqlOrder[$by] = " B.LID ".$order." ";
				elseif ($by == "iblock_type") $arSqlOrder[$by] = " B.IBLOCK_TYPE_ID ".$order." ";
				elseif ($by == "name") $arSqlOrder[$by] = " B.NAME ".$order." ";
				elseif ($by == "active") $arSqlOrder[$by] = " B.ACTIVE ".$order." ";
				elseif ($by == "sort") $arSqlOrder[$by] = " B.SORT ".$order." ";
				elseif ($by == "code") $arSqlOrder[$by] = " B.CODE ".$order." ";
				elseif ($bIncCnt && $by == "element_cnt") $arSqlOrder[$by] = " ELEMENT_CNT ".$order." ";
				else
				{
					$by = "timestamp_x";
					$arSqlOrder[$by] = " B.TIMESTAMP_X ".$order." ";
				}
			}
		}

		if(count($arSqlOrder) > 0)
			$strSqlOrder = " ORDER BY ".implode(",", $arSqlOrder);
		else
			$strSqlOrder = "";

		$res = $DB->Query($strSql.$strSqlOrder, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);
		return $res;
	}

	public static function _Upper($str)
	{
		return $str;
	}

	function _Add($ID)
	{
		global $DB;
		$err_mess = "FILE: ".__FILE__."<br>LINE: ";
		$ID = intval($ID);

		if(defined("MYSQL_TABLE_TYPE") && strlen(MYSQL_TABLE_TYPE) > 0)
		{
			$DB->Query("SET storage_engine = '".MYSQL_TABLE_TYPE."'", true);
		}
		$strSql = "
			CREATE TABLE IF NOT EXISTS b_iblock_element_prop_s".$ID." (
				IBLOCK_ELEMENT_ID 	int(11) not null REFERENCES b_iblock_element(ID),
				primary key (IBLOCK_ELEMENT_ID)
			)
		";
		$rs = $DB->DDL($strSql, false, $err_mess.__LINE__);
		$strSql = "
			CREATE TABLE IF NOT EXISTS b_iblock_element_prop_m".$ID." (
				ID			int(11) not null auto_increment,
				IBLOCK_ELEMENT_ID 	int(11) not null REFERENCES b_iblock_element(ID),
				IBLOCK_PROPERTY_ID	int(11) not null REFERENCES b_iblock_property(ID),
				VALUE			text	not null,
				VALUE_ENUM 		int(11),
				VALUE_NUM 		numeric(18,4),
				DESCRIPTION 		VARCHAR(255) NULL,
				PRIMARY KEY (ID),
				INDEX ix_iblock_elem_prop_m".$ID."_1(IBLOCK_ELEMENT_ID,IBLOCK_PROPERTY_ID),
				INDEX ix_iblock_elem_prop_m".$ID."_2(IBLOCK_PROPERTY_ID),
				INDEX ix_iblock_elem_prop_m".$ID."_3(VALUE_ENUM,IBLOCK_PROPERTY_ID)
			)
		";
		if($rs)
			$rs = $DB->DDL($strSql, false, $err_mess.__LINE__);
		return $rs;
	}

	public static function _Order($by, $order, $default_order, $nullable = true)
	{
		$o = parent::_Order($by, $order, $default_order, $nullable);
		//$o[0] - bNullsFirst
		//$o[1] - asc|desc
		if($o[0])
		{
			if($o[1] == "asc")
			{
				return $by." asc";
			}
			else
			{
				return "length(".$by.")>0 asc, ".$by." desc";
			}
		}
		else
		{
			if($o[1] == "asc")
			{
				return "length(".$by.")>0 desc, ".$by." asc";
			}
			else
			{
				return $by." desc";
			}
		}
	}

	public static function _NotEmpty($column)
	{
		return "if(".$column." is null, 0, 1)";
	}
}