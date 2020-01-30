<?php

$serverType = getenv('INTEGRATION_TYPE');

function getConfigFileS($mode) {
    $path =  __DIR__ . '/../config/config.'.$mode.'.ini';
    return parse_ini_file($path, true);
}

function getConfigModeS($serverType = '') {
    switch ($serverType) {
        case 'production':
        case 'local':
            return $serverType;
            break;
    }
    return 'test';
}

$configMode = getConfigModeS($serverType);
$configFile = getConfigFileS($configMode)['mysql'];

$DBHost = $configFile['host'];
$DBLogin = $configFile['login'];
$DBPassword = $configFile['password'];
$DBName = $configFile['dbname'];

return array (
  'utf_mode' => 
  array (
    'value' => true,
    'readonly' => true,
  ),
  'cache_flags' => 
  array (
    'value' => 
    array (
      'config_options' => 3600.0,
      'site_domain' => 3600.0,
    ),
    'readonly' => false,
  ),
  'cookies' => 
  array (
    'value' => 
    array (
      'secure' => false,
      'http_only' => true,
    ),
    'readonly' => false,
  ),
    'exception_handling' =>
        array (
            'value' =>
                array (
                    'debug' => true,
                    'handled_errors_types' => E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE & ~E_DEPRECATED,
                    'exception_errors_types' => E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_USER_WARNING & ~E_USER_NOTICE & ~E_COMPILE_WARNING,
                    'ignore_silence' => true,
                    'assertion_throws_exception' => false,
                    'assertion_error_type' => 256,
                    'log' => array (
                        'settings' => array (
                            'file' => 'bitrix/modules/error.log',
                            'log_size' => 1000000,
                        ),
                    ),
                ),
            'readonly' => true,
        ),
  'connections' => 
  array (
    'value' => 
    array (
      'default' => 
      array (
        'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
        'host' => $DBHost,
        'database' => $DBName,
        'login' => $DBLogin,
        'password' => $DBPassword,
        'options' => 2.0,
      ),
    ),
    'readonly' => true,
  ),
  'crypto' => 
  array (
    'value' => 
    array (
      'crypto_key' => '3e7a669a1f15953f7c00ce7aa855219f',
    ),
    'readonly' => true,
  ),
);
