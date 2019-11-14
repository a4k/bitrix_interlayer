<?

$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../../..';

$bxRootUrl = substr(__FILE__, 0,
        strlen(__FILE__) - strlen('/include.php')
    ) . '/bx_root.php';
require_once($bxRootUrl);


$startFileUrl = __DIR__ . '/../../modules/main/start.php';

require_once($startFileUrl);
$virtualIoUrl = __DIR__ . '/../../modules/main/classes/general/virtual_io.php';
require_once($virtualIoUrl);
$virtualFileUrl = __DIR__ . '/../../modules/main/classes/general/virtual_file.php';
require_once($virtualFileUrl);


$application = \Bitrix\Main\Application::getInstance();
$application->initializeExtendedKernel();

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


require_once($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/classes/' . $DBType . '/usertype.php');
if (file_exists(($updateDbPath = $_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/classes/general/update_db_updater.php'))) {
    include($updateDbPath);
}
if (file_exists(($updateDbPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/init.php'))) include_once($updateDbPath);

include_once($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/php_interface/init.php');


?>