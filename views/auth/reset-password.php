<?php
/*
 * Copyright (c) 2022.
 * User: Fesdam
 * project: WizarFrameWork
 * Date Created: $file.created
 * 6/30/22, 11:40 PM
 * Last Modified at: 6/30/22, 11:40 PM
 * Time: 11:40
 * @author Wizarphics <Wizarphics@gmail.com>
 *
 */

/** @var \app\models\User $model*/

use wizarphics\wizarframework\Application;

/**
 * @var \wizarphics\wizarframework\View $this
 */
$this->title = 'Reset your password';
section('pageHeading');
print "<h4>$this->title</h4>";
endSection(); ?>
<?php
section('form');
form_begin(route_to('/reset-password'), 'post') ?>
<?= passwordField($model, 'password', ['superClass' => 'position-relative'])->append('<button type="button" class="pwdhideshow"></button>') ?>
<?= passwordField($model, 'passwordConfirm', ['superClass' => 'position-relative'])->append('<button type="button" class="pwdhideshow"></button>') ?>
<?= hiddenField('selector', Application::$app->request->getVar('selector')) ?>
<?= hiddenField('validator', Application::$app->request->getVar('validator')) ?>
<?= submit_button($model, 'Send', ['class' => 'w-100 btn-danger']) ?>
<?=
form_close() ?>
<?php
endSection();
