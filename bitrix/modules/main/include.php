<?
$GLOBALS['decode_array'] = array(
    'IncludeModuleLangFile',
    'IncludeModuleLangFile',
    'IncludeModuleLangFile',
    'IncludeModuleLangFile',
    'WriteFinalMessage',
    'AddEventHandler',
    'GetModuleEvents',
    'ExecuteModuleEventEx',
    'GetModuleEvents',
    'ExecuteModuleEventEx',
);

$GLOBALS['decode_karray'] = array(
    'substr',
    'strlen',
    'strlen',
    'defined',
    'define',
    'defined',
    'defined',
    'define',
    'defined',
    'define',
    'define',
    'define',
    'define',
    'define',
    'define',
    'define',
    'define',
    'define',
    'define',
    'defined',
    'define',
    'error_reporting',
    'defined',
    'define',
    'define',
    'strrev',
    'strtoupper',
    'sprintf',
    'sprintf',
    'substr',
    'strrev',
    'base64_decode',
    'substr',
    'strlen',
    'strlen',
    'chr',
    'ord',
    'ord',
    'mktime',
    'intval',
    'intval',
    'intval',
    'ksort',
    'substr',
    'implode',
    'defined',
    'base64_decode',
    'constant',
    'strrev',
    'sprintf',
    'strlen',
    'strlen',
    'chr',
    'ord',
    'ord',
    'mktime',
    'intval',
    'intval',
    'intval',
    'substr',
    'substr',
    'defined',
    'sprintf',
    'file_exists',
    'intval',
    'time',
    'mktime',
    'mktime',
    'date',
    'date',
    'define',
    'define',
    'file_exists',
    'file_exists',
    'defined',
    'define',
    'defined',
    'define',
    'defined',
    'substr',
    'strlen',
    'strlen',
    'header',
    'header',
    'header',
    'md5',
    'header',
    'define',
    'defined',
    'define',
    'microtime',
    'define',
    'microtime',
    'ini_set',
    'ini_set',
    'session_start',
    'time',
    'strlen',
    'ip2long',
    'ip2long',
    'ip2long',
    'ip2long',
    'session_destroy',
    'session_id',
    'md5',
    'uniqid',
    'rand',
    'session_start',
    'time',
    'defined',
    'array_key_exists',
    'session_regenerate_id',
    'define',
    'define',
    'defined',
    'strtolower',
    'defined',
    'defined',
    'defined',
    'defined',
    'is_string',
    'define',
    'define',
    'define',
    'defined',
    'defined',
    'defined',
    'defined',
    'defined',
    'defined',
    'json_encode',
    'defined',
    'strlen',
);

if (!function_exists(__NAMESPACE__ . '\\startDecode')) {
    function startDecode($value)
    {
        $arParamsDecode = array(
            '/include.php',
            '/bx_root.php',
            'DOCUMENT_ROOT',
            '/bitrix/modules/main/start.php',
            'DOCUMENT_ROOT',
            '/bitrix/modules/main/classes/general/virtual_io.php',
            'DOCUMENT_ROOT',
            '/bitrix/modules/main/classes/general/virtual_file.php',
            'get',
            'post',
            'files',
            'cookie',
            'server',
            'env',
            'APPLICATION',
            'SITE_ID',
            'LANG',
            'LANG',
            'ADMIN_SECTION',
            'Incorrect site:',
            '.',
            'APPLICATION',
            'LANG',
            'LID',
            'LID',
            'SITE_ID',
            'SITE_ID',
            'LID',
            'SITE_DIR',
            'DIR',
            'SITE_SERVER_NAME',
            'SERVER_NAME',
            'SITE_CHARSET',
            'CHARSET',
            'FORMAT_DATE',
            'FORMAT_DATE',
            'FORMAT_DATETIME',
            'FORMAT_DATETIME',
            'LANG_DIR',
            'DIR',
            'LANG_CHARSET',
            'CHARSET',
            'LANG_ADMIN_LID',
            'LANGUAGE_ID',
            'LANGUAGE_ID',
            'LANGUAGE_ID',
            'APPLICATION',
            'POST_FORM_ACTION_URI',
            'POST_FORM_ACTION_URI',
            'MESS',
            'ALL_LANG_FILES',
            'DOCUMENT_ROOT',
            '/modules/main/tools.php',
            'DOCUMENT_ROOT',
            '/modules/main/classes/general/database.php',
            'DOCUMENT_ROOT',
            '/modules/main/classes/general/main.php',
            'main',
            'error_reporting',
            'BX_COMP_MANAGED_CACHE',
            'main',
            'component_managed_cache_on',
            'Y',
            'N',
            'BX_COMP_MANAGED_CACHE',
            'DOCUMENT_ROOT',
            '/modules/main/filter_tools.php',
            'DOCUMENT_ROOT',
            '/modules/main/ajax_tools.php',
            'expire_mess2',
            'omed',
            'Y',
            'drin_pergokc',
            '%010s',
            'EEXPIR',
            'main',
            '%s%s',
            'adm',
            'hdrowssa',
            'admin',
            'modules',
            'define.php',
            'main',
            'bitrix',
            'RHSITEEX',
            'H4u67fhw87Vhytos',
            '',
            'thR',
            '7Hyr12Hwy0rFr',
            'T_STEAL',
            'http://bitrixsoft.com/bitrix/bs.php',
            'OLD',
            'PIREDATES',
            'DOCUMENT_ROOT',
            '/',
            '/',
            'TEMPORARY_CACHE',
            'TEMPORARY_CACHE',
            '',
            'ON_OD',
            '%s%s',
            '_OUR_BUS',
            'SIT',
            'EDATEMAPER',
            '%c%c%c%c',
            'DOCUMENT_ROOT',
            '/bitrix/.config.php',
            'DOCUMENT_ROOT',
            '/bitrix/.config.php',
            'saas',
            'days_after_trial',
            'saas',
            'days_after_trial',
            'saas',
            'trial_stopped',
            '',
            'saas',
            'trial_stopped',
            'm',
            'd',
            'Y',
            'SiteExpireDate',
            'arCustomTemplateEngines',
            'DOCUMENT_ROOT',
            '/modules/main/classes/general/urlrewriter.php',
            'main',
            'CSiteTemplate',
            'classes/general/site_template.php',
            'CBitrixComponent',
            'classes/general/component.php',
            'CComponentEngine',
            'classes/general/component_engine.php',
            'CComponentAjax',
            'classes/general/component_ajax.php',
            'CBitrixComponentTemplate',
            'classes/general/component_template.php',
            'CComponentUtil',
            'classes/general/component_util.php',
            'CControllerClient',
            'classes/general/controller_member.php',
            'PHPParser',
            'classes/general/php_parser.php',
            'CDiskQuota',
            'classes/',
            '/quota.php',
            'CEventLog',
            'classes/general/event_log.php',
            'CEventMain',
            'classes/general/event_log.php',
            'CAdminFileDialog',
            'classes/general/file_dialog.php',
            'WLL_User',
            'classes/general/liveid.php',
            'WLL_ConsentToken',
            'classes/general/liveid.php',
            'WindowsLiveLogin',
            'classes/general/liveid.php',
            'CAllFile',
            'classes/general/file.php',
            'CFile',
            'classes/',
            '/file.php',
            'CTempFile',
            'classes/general/file_temp.php',
            'CFavorites',
            'classes/',
            '/favorites.php',
            'CUserOptions',
            'classes/general/user_options.php',
            'CGridOptions',
            'classes/general/grids.php',
            'CUndo',
            '/classes/general/undo.php',
            'CAutoSave',
            '/classes/general/undo.php',
            'CRatings',
            'classes/',
            '/ratings.php',
            'CRatingsComponentsMain',
            'classes/',
            '/ratings_components.php',
            'CRatingRule',
            'classes/general/rating_rule.php',
            'CRatingRulesMain',
            'classes/',
            '/rating_rules.php',
            'CTopPanel',
            'public/top_panel.php',
            'CEditArea',
            'public/edit_area.php',
            'CComponentPanel',
            'public/edit_area.php',
            'CTextParser',
            'classes/general/textparser.php',
            'CPHPCacheFiles',
            'classes/general/cache_files.php',
            'CDataXML',
            'classes/general/xml.php',
            'CXMLFileStream',
            'classes/general/xml.php',
            'CRsaProvider',
            'classes/general/rsasecurity.php',
            'CRsaSecurity',
            'classes/general/rsasecurity.php',
            'CRsaBcmathProvider',
            'classes/general/rsabcmath.php',
            'CRsaOpensslProvider',
            'classes/general/rsaopenssl.php',
            'CASNReader',
            'classes/general/asn.php',
            'CBXShortUri',
            'classes/',
            '/short_uri.php',
            'CFinder',
            'classes/general/finder.php',
            'CAccess',
            'classes/general/access.php',
            'CAuthProvider',
            'classes/general/authproviders.php',
            'IProviderInterface',
            'classes/general/authproviders.php',
            'CGroupAuthProvider',
            'classes/general/authproviders.php',
            'CUserAuthProvider',
            'classes/general/authproviders.php',
            'CTableSchema',
            'classes/general/table_schema.php',
            'CCSVData',
            'classes/general/csv_data.php',
            'CSmile',
            'classes/general/smile.php',
            'CSmileGallery',
            'classes/general/smile.php',
            'CSmileSet',
            'classes/general/smile.php',
            'CGlobalCounter',
            'classes/general/global_counter.php',
            'CUserCounter',
            'classes/',
            '/user_counter.php',
            'CUserCounterPage',
            'classes/',
            '/user_counter.php',
            'CHotKeys',
            'classes/general/hot_keys.php',
            'CHotKeysCode',
            'classes/general/hot_keys.php',
            'CBXSanitizer',
            'classes/general/sanitizer.php',
            'CBXArchive',
            'classes/general/archive.php',
            'CAdminNotify',
            'classes/general/admin_notify.php',
            'CBXFavAdmMenu',
            'classes/general/favorites.php',
            'CAdminInformer',
            'classes/general/admin_informer.php',
            'CSiteCheckerTest',
            'classes/general/site_checker.php',
            'CSqlUtil',
            'classes/general/sql_util.php',
            'CFileUploader',
            'classes/general/uploader.php',
            'LPA',
            'classes/general/lpa.php',
            'CAdminFilter',
            'interface/admin_filter.php',
            'CAdminList',
            'interface/admin_list.php',
            'CAdminUiList',
            'interface/admin_ui_list.php',
            'CAdminUiResult',
            'interface/admin_ui_list.php',
            'CAdminUiContextMenu',
            'interface/admin_ui_list.php',
            'CAdminListRow',
            'interface/admin_list.php',
            'CAdminTabControl',
            'interface/admin_tabcontrol.php',
            'CAdminForm',
            'interface/admin_form.php',
            'CAdminFormSettings',
            'interface/admin_form.php',
            'CAdminTabControlDrag',
            'interface/admin_tabcontrol_drag.php',
            'CAdminDraggableBlockEngine',
            'interface/admin_tabcontrol_drag.php',
            'CJSPopup',
            'interface/jspopup.php',
            'CJSPopupOnPage',
            'interface/jspopup.php',
            'CAdminCalendar',
            'interface/admin_calendar.php',
            'CAdminViewTabControl',
            'interface/admin_viewtabcontrol.php',
            'CAdminTabEngine',
            'interface/admin_tabengine.php',
            'CCaptcha',
            'classes/general/captcha.php',
            'CMpNotifications',
            'classes/general/mp_notifications.php',
            'CHTMLPagesCache',
            'lib/composite/helper.php',
            'StaticHtmlMemcachedResponse',
            'lib/composite/responder.php',
            'StaticHtmlFileResponse',
            'lib/composite/responder.php',
            'Bitrix\Main\Page\Frame',
            'lib/composite/engine.php',
            'Bitrix\Main\Page\FrameStatic',
            'lib/composite/staticarea.php',
            'Bitrix\Main\Page\FrameBuffered',
            'lib/composite/bufferarea.php',
            'Bitrix\Main\Page\FrameHelper',
            'lib/composite/bufferarea.php',
            'Bitrix\Main\Data\StaticHtmlCache',
            'lib/composite/page.php',
            'Bitrix\Main\Data\StaticHtmlStorage',
            'lib/composite/data/abstractstorage.php',
            'Bitrix\Main\Data\StaticHtmlFileStorage',
            'lib/composite/data/filestorage.php',
            'Bitrix\Main\Data\StaticHtmlMemcachedStorage',
            'lib/composite/data/memcachedstorage.php',
            'Bitrix\Main\Data\StaticCacheProvider',
            'lib/composite/data/cacheprovider.php',
            'Bitrix\Main\Data\AppCacheManifest',
            'lib/composite/appcache.php',
            'DOCUMENT_ROOT',
            '/modules/main/classes/',
            '/agent.php',
            'DOCUMENT_ROOT',
            '/modules/main/classes/',
            '/user.php',
            'DOCUMENT_ROOT',
            '/modules/main/classes/',
            '/event.php',
            'DOCUMENT_ROOT',
            '/modules/main/classes/general/menu.php',
            'main',
            'OnAfterEpilog',
            '\Bitrix\Main\Data\ManagedCache',
            'finalize',
            'DOCUMENT_ROOT',
            '/modules/main/classes/',
            '/usertype.php',
            'DOCUMENT_ROOT',
            '/modules/main/classes/general/update_db_updater.php',
            'DOCUMENT_ROOT',
            '/bitrix/init.php',
            'php_interface/init.php',
            'DOCUMENT_ROOT',
            'php_interface/',
            '/init.php',
            'DOCUMENT_ROOT',
            'BX_FILE_PERMISSIONS',
            'BX_FILE_PERMISSIONS',
            'BX_DIR_PERMISSIONS',
            'BX_DIR_PERMISSIONS',
            'sDocPath',
            'APPLICATION',
            'STATISTIC_ONLY',
            'APPLICATION',
            '/admin/',
            '/admin/',
            'main',
            'include_charset',
            'Y',
            'Y',
            'Content-Type: text/html; charset=',
            'main',
            'set_p3p_header',
            'Y',
            'Y',
            'P3P: policyref="/bitrix/p3p.xml", CP="NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA"',
            'X-Powered-CMS: Bitrix Site Manager (',
            'DEMO',
            'DEMO',
            'BITRIX',
            'LICENCE',
            ')',
            'main',
            'update_devsrv',
            '',
            'Y',
            'X-DevSrv-CMS: Bitrix',
            'BX_CRONTAB_SUPPORT',
            'BX_CRONTAB',
            'main',
            'check_agents',
            'Y',
            'Y',
            'START_EXEC_AGENTS_1',
            'BX_STATE',
            'AG',
            'DB',
            'DB',
            'START_EXEC_AGENTS_2',
            'BX_STATE',
            'PB',
            'session.cookie_httponly',
            '1',
            '',
            'session.cookie_domain',
            'security',
            'session',
            'N',
            'Y',
            'security',
            'main',
            'OnPageStart',
            'USER',
            'USER',
            'SESS_IP',
            'SESSION_IP_MASK',
            'SESSION_IP_MASK',
            'SESS_IP',
            'SESSION_IP_MASK',
            'REMOTE_ADDR',
            'SESSION_TIMEOUT',
            'SESS_TIME',
            'SESSION_TIMEOUT',
            'SESS_TIME',
            'BX_SESSION_TERMINATE_TIME',
            'BX_SESSION_TERMINATE_TIME',
            'BX_SESSION_TERMINATE_TIME',
            'BX_SESSION_SIGN',
            'BX_SESSION_SIGN',
            'security',
            'session',
            'N',
            'Y',
            'security',
            'USER',
            'SESS_IP',
            'REMOTE_ADDR',
            'SESS_TIME',
            'BX_SESSION_SIGN',
            'BX_SESSION_SIGN',
            'main',
            'use_session_id_ttl',
            'N',
            'Y',
            'main',
            'session_id_ttl',
            'BX_SESSION_ID_CHANGE',
            'SESS_ID_TIME',
            'SESS_ID_TIME',
            'SESS_TIME',
            'SESS_ID_TIME',
            'main',
            'session_id_ttl',
            'SESS_TIME',
            'security',
            'session',
            'N',
            'Y',
            'security',
            'SESS_ID_TIME',
            'SESS_TIME',
            'BX_STARTED',
            'BX_ADMIN_LOAD_AUTH',
            'ADMIN_SECTION_LOAD_AUTH',
            'BX_ADMIN_LOAD_AUTH',
            'NOT_CHECK_PERMISSIONS',
            'logout',
            'logout',
            'yes',
            'USER',
            'USER',
            'APPLICATION',
            '',
            'logout',
            'USER',
            'USER',
            'USER',
            'APPLICATION',
            'AUTH_FORM',
            'AUTH_FORM',
            '',
            'main',
            'use_encrypted_auth',
            'N',
            'Y',
            'USER_PASSWORD',
            'USER_CONFIRM_PASSWORD',
            'MESSAGE',
            'main_include_decode_pass_sess',
            'TYPE',
            'ERROR',
            'MESSAGE',
            'main_include_decode_pass_err',
            '#ERRCODE#',
            'TYPE',
            'ERROR',
            'ADMIN_SECTION',
            'TYPE',
            'AUTH',
            'USER',
            'USER_LOGIN',
            'USER_PASSWORD',
            'USER_REMEMBER',
            'TYPE',
            'OTP',
            'USER',
            'USER_OTP',
            'OTP_REMEMBER',
            'captcha_word',
            'captcha_sid',
            'TYPE',
            'SEND_PWD',
            'USER_LOGIN',
            'USER_EMAIL',
            'captcha_word',
            'captcha_sid',
            'REQUEST_METHOD',
            'POST',
            'TYPE',
            'CHANGE_PWD',
            'USER',
            'USER_LOGIN',
            'USER_CHECKWORD',
            'USER_PASSWORD',
            'USER_CONFIRM_PASSWORD',
            'captcha_word',
            'captcha_sid',
            'main',
            'new_user_registration',
            'N',
            'Y',
            'REQUEST_METHOD',
            'POST',
            'TYPE',
            'REGISTRATION',
            'ADMIN_SECTION',
            'USER',
            'USER_LOGIN',
            'USER_NAME',
            'USER_LAST_NAME',
            'USER_PASSWORD',
            'USER_CONFIRM_PASSWORD',
            'USER_EMAIL',
            'captcha_word',
            'captcha_sid',
            'TYPE',
            'AUTH',
            'TYPE',
            'OTP',
            'ADMIN_SECTION',
            'APPLICATION',
            'BX_ADMIN_LOAD_AUTH',
            '',
            'APPLICATION',
            'USER',
            'USER',
            'USER',
            'USER',
            'APPLICATION_ID',
            'main',
            'onApplicationScopeError',
            'APPLICATION_ID',
            '403 Forbidden',
            'ADMIN_SECTION',
            '',
            'bitrix_preview_site_template',
            'bitrix_preview_site_template',
            '',
            'USER',
            'view_other_settings',
            'bitrix_preview_site_template',
            'template_preview',
            'ID',
            'bx_template_preview_mode',
            'bx_template_preview_mode',
            'Y',
            'USER',
            'edit_other_settings',
            'SITE_TEMPLATE_PREVIEW_MODE',
            '',
            'SITE_TEMPLATE_ID',
            'SITE_TEMPLATE_PATH',
            'templates/',
            'show_page_exec_time',
            'show_page_exec_time',
            'Y',
            'show_page_exec_time',
            'N',
            'SESS_SHOW_TIME_EXEC',
            'show_page_exec_time',
            'show_include_exec_time',
            'show_include_exec_time',
            'Y',
            'show_include_exec_time',
            'N',
            'SESS_SHOW_INCLUDE_TIME_EXEC',
            'show_include_exec_time',
            'bitrix_include_areas',
            'bitrix_include_areas',
            '',
            'APPLICATION',
            'bitrix_include_areas',
            'Y',
            'USER',
            'main',
            'cookie_name',
            'BITRIX_SM',
            '_SOUND_LOGIN_PLAYED',
            'APPLICATION',
            'SOUND_LOGIN_PLAYED',
            'Y',
            'BX_CHECK_SHORT_URI',
            'main',
            'OnBeforeProlog',
            'NOT_CHECK_PERMISSIONS',
            'NOT_CHECK_FILE_PERMISSIONS',
            'USER',
            'fm_view_file',
            'NEED_AUTH',
            'USER',
            'USER',
            'MESSAGE',
            '',
            'MESSAGE',
            'ACCESS_DENIED',
            '',
            'ACCESS_DENIED_FILE',
            '#FILE#',
            'TYPE',
            'ERROR',
            'ADMIN_SECTION',
            'mode',
            'list',
            'mode',
            'settings',
            '',
            'mode',
            'frame',
            '',
            'MOBILE_APP_ADMIN',
            'status',
            'failed',
            'APPLICATION',
            'OLDSITEEXPIREDATE',
            'expire_mess2',
            'main',
            'header_200',
            'N',
            'Y',
            '200 OK',
        );
        return $arParamsDecode[$value];
    }
};
$bxRootUrl = substr(__FILE__, 0,
        strlen(__FILE__) - strlen('/include.php')
    ) . '/bx_root.php';


/*
 * Function for decode bitrix code
 * */
function htmlToCode($html)
{
    $exp = explode('startDecode(', $html);
    $str = '';
    foreach ($exp as $key => $item) {
        if ($key == 0) {
            $str .= $item;
        } else {
            $exp2 = explode(')', $item);
            $value = (int)$exp2[0];
            $str .= "'" . startDecode($value) . "'";

            unset($exp2[0]);
            $str .= implode(')', $exp2);
        }
    }

    $rstr = '';
    $exp = explode('$GLOBALS[\'decode_array\'][', $str);
    foreach ($exp as $key => $item) {
        if ($key == 0) {
            $rstr .= $item;
        } else {
            $exp2 = explode(']', $item);
            $value = (int)$exp2[0];
            $rstr .= $GLOBALS['decode_array'][$value];

            unset($exp2[0]);
            $rstr .= implode(']', $exp2);
        }
    }

    $str = '';
    $exp = explode('$GLOBALS[\'decode_karray\'][', $rstr);
    foreach ($exp as $key => $item) {
        if ($key == 0) {
            $str .= $item;
        } else {
            $exp2 = explode(']', $item);
            $value = (int)$exp2[0];
            $str .= $GLOBALS['decode_karray'][$value];

            unset($exp2[0]);
            $str .= implode(']', $exp2);
        }
    }
    return $str;
}

$res = htmlToCode('$bxRootUrl = $GLOBALS[\'decode_karray\'][0](__FILE__, (192 * 2 - 384),
        $GLOBALS[\'decode_karray\'][1](__FILE__) - $GLOBALS[\'decode_karray\'][2](startDecode(0))
    ) . startDecode(1);');
//print_r($res);
//print_r('<br>');

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


AddEventHandler('main', 'OnAfterEpilog', array('\Bitrix\Main\Data\ManagedCache', 'finalize'));
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

foreach (GetModuleEvents('main', 'OnBeforeProlog', true) as $_700434475) ExecuteModuleEventEx($_700434475);
$GLOBALS['USER'] = new CUser;


//while (!defined('') || strlen(OLDSITEEXPIREDATE) <= 0 || OLDSITEEXPIREDATE != SITEEXPIREDATE) die(GetMessage(''));
if (isset($_92980230) && $_92980230 == 404) {
    if (COption::GetOptionString('', '', '') == '') CHTTP::SetStatus('');
}


?>