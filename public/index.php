<?php
/*
 * Copyright (c) 2022.
 * User: Fesdam
 * project: WizarFrameWork
 * Date Created: $file.created
 * 6/30/22, 8:19 PM
 * Last Modified at: 6/30/22, 8:18 PM
 * Time: 8:19
 * @author Wizarphics <Wizarphics@gmail.com>
 *
 */

use wizarphics\wizarframework\Application;

define('ASKPHP_START', microtime(true));

define('ROOT_DIR', dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/
require_once __DIR__ . '/../vendor/autoload.php';

/*
 * ---------------------------------------------------------------
 * Require Bootstrap
 * ---------------------------------------------------------------
 */
$app = require_once Application::$CORE_DIR . 'bootstrap.php';

/** @var Application $app */

// s($_COOKIE, $_SESSION);

/*
 * ---------------------------------------------------------------
 * Run The Application
 * ---------------------------------------------------------------
 */
$app->run();
