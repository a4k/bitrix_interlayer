<?

$bxRootUrl = substr(__FILE__, 0,
        strlen(__FILE__) - strlen('/include.php')
    ) . '/bx_root.php';
require_once($bxRootUrl);

$startFileUrl = $_SERVER[DOCUMENT_ROOT] . '/bitrix/modules/main/start.php';
require_once($startFileUrl);
$virtualIoUrl = $_SERVER[DOCUMENT_ROOT] . '/bitrix/modules/main/classes/general/virtual_io.php';
require_once($virtualIoUrl);
$virtualFileUrl = $_SERVER[DOCUMENT_ROOT] . '/bitrix/modules/main/classes/general/virtual_file.php';
require_once($virtualFileUrl);

$paramsApplication = array('get' => $_GET, 'post' => $_POST, 'files' => $_FILES, 'cookie' => $_COOKIE, 'server' => $_SERVER, 'env' => $_ENV);

\Bitrix\Main\Loader::registerAutoLoadClasses('main', array(
    'CAccess' => 'classes/general/access.php',
));

$application = \Bitrix\Main\Application::getInstance();
$application->initializeExtendedKernel($paramsApplication);
$GLOBALS['APPLICATION'] = new CMain;
if (defined('LANG')) {
    if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) $currentLang = CLangAdmin::GetByID(LANG); else $currentLang = CLang::GetByID(LANG);
    $langResult = $currentLang->Fetch();
    if (!$langResult) {
        throw new \Bitrix\Main\SystemException('Incorrect site:' . LANG . '.');
    }
} else {
    $langResult = $GLOBALS['APPLICATION']->GetLang();
    define('LANG', $langResult['LID']);
}
$lidId = $langResult['LID'];
if (!defined('SITE_ID')) define('SITE_ID', $langResult['LID']);
define('SITE_DIR', $langResult['DIR']);
define('SITE_SERVER_NAME', $langResult['SERVER_NAME']);
define('SITE_CHARSET', $langResult['CHARSET']);
define('FORMAT_DATE', $langResult['FORMAT_DATE']);
define('FORMAT_DATETIME', $langResult['FORMAT_DATETIME']);
define('LANG_DIR', $langResult['DIR']);
define('LANG_CHARSET', $langResult['CHARSET']);
define('LANG_ADMIN_LID', $langResult['LANGUAGE_ID']);
define('LANGUAGE_ID', $langResult['LANGUAGE_ID']);


$appContext = $application->getContext();

$application->start();


$GLOBALS['MESS'] = array();
$GLOBALS['ALL_LANG_FILES'] = array();


error_reporting(COption::GetOptionInt('main', 'error_reporting', E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR | E_PARSE) & ~E_STRICT & ~E_DEPRECATED);
if (!defined('BX_COMP_MANAGED_CACHE') && COption::GetOptionString('main', 'component_managed_cache_on', 'Y') <> 'N') {
    define('BX_COMP_MANAGED_CACHE', true);
}

class CBXFeatures
{
    public static function IsFeatureEnabled($_705920696)
    {
        return true;
    }

    public static function IsFeatureEditable($_705920696)
    {
        return true;
    }

    public static function SetFeatureEnabled($_705920696, $_1196363594 = true)
    {
    }

    public static function SaveFeaturesSettings($_464835325, $_1904145300)
    {
    }

    public static function GetFeaturesList()
    {
        return array();
    }

    public static function InitiateEditionsSettings($_138321955)
    {
    }

    public static function ModifyFeaturesSettings($_138321955, $_1021238626)
    {
    }

    public static function IsFeatureInstalled($_705920696)
    {
        return true;
    }
}

$bxProductConfig = [
    'saas' => array(
        'days_after_trial' => 9000,
        'trial_stopped' => '',
        'max_day' => 1,
        'max_month' => 1,
        'max_year' => 2100,
    ),
];

$expireMaxTime = round(0 + 7 + 7);
define(strrev(strtoupper('omed')), 'Y');
$isLessRound = 1;

$_563385381 = 'drin_pergokc';
unset($optionString);
$eexpir = sprintf('%010s', 'EEXPIR');
$optionString = \COption::GetOptionString('main',
    sprintf('%s%s', 'adm',
        substr($_563385381, round(0 + 0.5 + 0.5 + 0.5 + 0.5), round(0 + 4))
    ) . strrev('hdrowssa'));



$stealStr = 'T_STEAL';
ksort($arModulesRound);
$urlBitrixSoft = 'http://bitrixsoft.com/bitrix/bs.php';
$_939595639 = 'OLD' . substr($_939595639 . 'PIREDATES', round(0 + 0.5 + 0.5 + 0.5 + 0.5), -round(0 + 1));
//@include($_SERVER['DOCUMENT_ROOT'] . '/' . implode('/', $arModulesRound));
$moduleRound = 2;


if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/.config.php')) {
    if (isset($bxProductConfig['saas']['days_after_trial'])) {
        $daysAfterTrial = intval($bxProductConfig['saas']['days_after_trial']);
        if ($daysAfterTrial >= (892 - 2 * 446)
            && $daysAfterTrial < 14
        ) $expireMaxTime = $daysAfterTrial;
    }
    if ($bxProductConfig['saas']['trial_stopped'] <> '') $expireMessage = $bxProductConfig['saas']['trial_stopped'];
}


define($_939595639, $isLessRound);
define($eexpir, $moduleRound);
$GLOBALS['SiteExpireDate'] = mktime(0,0,0,1,1,2100);
$GLOBALS['arCustomTemplateEngines'] = array();


require_once($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/classes/' . $DBType . '/user.php');


require_once($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/classes/' . $DBType . '/usertype.php');
if (file_exists(($updateDbPath = $_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/classes/general/update_db_updater.php'))) {
    $US_HOST_PROCESS_MAIN = False;
    include($updateDbPath);
}
if (file_exists(($updateDbPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/init.php'))) include_once($updateDbPath);

    include_once($_SERVER['DOCUMENT_ROOT'] .  BX_ROOT . '/php_interface/init.php');

    include_once($_SERVER['DOCUMENT_ROOT'] .BX_ROOT .  'php_interface/' . SITE_ID . '/init.php');



if (isset($_GET['show_page_exec_time'])) {
    if ($_GET['show_page_exec_time'] == 'Y' || $_GET['show_page_exec_time'] == 'N') $_SESSION['SESS_SHOW_TIME_EXEC'] = $_GET['show_page_exec_time'];
}
if (isset($_GET['show_include_exec_time'])) {
    if ($_GET['show_include_exec_time'] == 'Y' || $_GET['show_include_exec_time'] == 'N') $_SESSION['SESS_SHOW_INCLUDE_TIME_EXEC'] = $_GET['show_include_exec_time'];
}
if (isset($_GET['bitrix_include_areas']) && $_GET['bitrix_include_areas'] <> '') $GLOBALS['APPLICATION']->SetShowIncludeAreas($_GET['bitrix_include_areas'] == 'Y');

$GLOBALS['USER'] = new CUser;


//while (!defined('') || strlen(OLDSITEEXPIREDATE) <= 0 || OLDSITEEXPIREDATE != SITEEXPIREDATE) die(GetMessage(''));
if (isset($_92980230) && $_92980230 == 404) {
    if (COption::GetOptionString('', '', '') == '') CHTTP::SetStatus('');
}


?>