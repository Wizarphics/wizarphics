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


/**
 * @var \wizarphics\wizarframework\View $this
 */
$this->title = 'Recover your account';
section('pageHeading');
print '<h4>Recover your account</h4>';
print '<small>It happens. Enter your email address and we\'ll send you a link to reset your password.</small>';
endSection();?>
<?php
section('form');
?>
<?php form_begin(route_to('forgot-password'), 'post') ?>
<?= emailField($model, 'email') ?>
<?= submit_button($model, 'Send', ['class' => 'w-100 btn-danger']) ?>
<?= form_close() ?>
<?php
endSection();
