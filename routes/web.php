<?php

use app\controllers\AppController;
use wizarphics\wizarframework\http\Request;
use wizarphics\wizarframework\http\Response;

/**
 * @var wizarphics\wizarframework\Router $router
 */

$router->get('/', [AppController::class, "home"]);
$router->get('/lets-talk', [AppController::class, 'talk'])->name('talk');
$router->post('/letsTalk', [AppController::class, 'talkForm'])->name('talk');
$router->get('/about', [AppController::class, 'about'])->name('about');
$router->get('/blog', [AppController::class, 'blog'])->name('blog');

$router->get('/view/{dir}/{name}', function ($dir, $name, Request $request, Response $response) {
    /**
     * @var \wizarphics\wizarframework\View $view
     */
    $view = app()->view;
    $view->title = ucfirst(esc($name));
    return $view->renderCustomView(VIEWPATH . $dir . '/' . $name);
});