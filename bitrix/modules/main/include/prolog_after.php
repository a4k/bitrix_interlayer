<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2013 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global $SiteExpireDate
 */

use Bitrix\Main;

global $APPLICATION;

define("START_EXEC_PROLOG_AFTER_1", microtime());
$GLOBALS["BX_STATE"] = "PA";

if(!headers_sent())
	header("Content-type: text/html; charset=".LANG_CHARSET);




/* Draw edit menu for whole content */
global $BX_GLOBAL_AREA_EDIT_ICON;
$BX_GLOBAL_AREA_EDIT_ICON = false;

define("START_EXEC_PROLOG_AFTER_2", microtime());
$GLOBALS["BX_STATE"] = "WA";
$APPLICATION->RestartWorkarea(true);

