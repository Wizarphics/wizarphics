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

/** @var \app\models\User $model */


/**
 * @var \wizarphics\wizarframework\View $this
 */
$this->title = 'Register';
section('pageHeading');
print '<h4>Choose your account details</h4>';
endSection();
?>
<?php section('form') ?>
<?php form_begin_multipart('', 'post') ?>
<div class="row">
    <div class="col-md-6">
        <?= textField($model, 'firstname') ?>
    </div>
    <div class="col-md-6">
        <?= textField($model, 'lastname') ?>
    </div>
</div>
<?= emailField($model, 'email') ?>
<?= passwordField($model, 'password', [
    'superClass' => 'position-relative'
])->append('
<button type="button" class="pwdhideshow" tabindex="-1" id="pwdhideshow"></button>
') ?>
<?= passwordField($model, 'passwordConfirm', [
    'superClass' => 'position-relative'
])->append('
<button type="button" class="pwdhideshow" tabindex="-1"></button>
') ?>
<?= submit_button($model, 'Send', ['class' => 'w-100 btn-danger']) ?>
<p class="text-center mt-5">Already got an account? <a href="<?= ('/auth/login') ?>" class="text-danger">Sign In</a></p>
<?= form_close() ?>
<?php endSection() ?>