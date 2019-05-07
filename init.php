<?php
// define the autoloader

ini_set('error_log', 'tmp/php_errors.log');

require_once 'lib/adianti/core/AdiantiCoreLoader.php';
spl_autoload_register(array('Adianti\Core\AdiantiCoreLoader', 'autoload'));
Adianti\Core\AdiantiCoreLoader::loadClassMap();

$loader = require 'vendor/autoload.php';
$loader->register();

// read configurations
$ini = @parse_ini_file('app/config/application.ini', true);
date_default_timezone_set($ini['general']['timezone']??'America/Sao_Paulo');
AdiantiCoreTranslator::setLanguage( $ini['general']['language']??'pt' );
ApplicationTranslator::setLanguage( $ini['general']['language']??'pt' );
AdiantiApplicationConfig::load($ini);

// define constants
define('APPLICATION_NAME', $ini['general']['application']??'eventtus');
define('OS', strtoupper(substr(PHP_OS, 0, 3)));
define('PATH', dirname(__FILE__));
define('LANG', $ini['general']['language']??'pt');

if (version_compare(PHP_VERSION, '5.5.0') == -1)
{
    die(AdiantiCoreTranslator::translate('The minimum version required for PHP is ^1', '5.5.0'));
}
