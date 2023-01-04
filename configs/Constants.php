<?php

defined('COMPOSER_PATH') || define('COMPOSER_PATH', realpath(ROOT_DIR . 'vendor/autoload.php'));
defined('VENDORPATH')    || define('VENDORPATH', realpath(ROOT_DIR . 'vendor') . DIRECTORY_SEPARATOR);
define('APP_NAMESPACE', "app\\");
defined('ENVIRONMENT')   || define('ENVIRONMENT', 'development');
defined('SEED_PATH')     || define('SEED_PATH', ROOT_DIR.'/seeders');
