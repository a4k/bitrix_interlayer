<?
require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/usertype.php");


class CSQLWhere extends CAllSQLWhere
{
	function _Empty($field)
	{
		return "(".$field." IS NULL OR ".$field." = '')";
	}
	function _NotEmpty($field)
	{
		return "(".$field." IS NOT NULL AND LENGTH(".$field.") > 0)";
	}
}

/**
 * ��� ���������� �������� ��������� ������ ����� API ��������
 * � ���������� ������ � ����������������� ����������.
 * @global CUserTypeManager $GLOBALS['USER_FIELD_MANAGER']
 * @name $USER_FIELD_MANAGER
 */
$GLOBALS['USER_FIELD_MANAGER'] = new CUserTypeManager;
?>