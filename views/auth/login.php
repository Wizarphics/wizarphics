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
$this->title = 'Login';
section('pageHeading');
print '<h4>Login</h4>';
endSection(); ?>
<?php
section('form');
?>
<?php form_begin(route_to('login'), 'post') ?>
<?= emailField($model, 'email') ?>
<?= passwordField($model, 'password', [
    'superClass' => 'position-relative'
])->append('
<button type="button" class="pwdhideshow" tabindex="-1" id="pwdhideshow"></button>
') ?>
<div class="row g-0 row-cols-2">
    <div class="col">
        <?= checkBoxField($model, 'remberMe') ?>
    </div>
    <div class="col">
        <a href="<?= ('/auth/forgot-password') ?>">Forgot Password</a>
    </div>
</div>
<?= submit_button($model, 'Send', ['class' => 'w-100 btn-primary']) ?>
<?= form_close() ?>
<p class="text-center mt-5">Not a member? <a href="<?= route_to('register') ?>">Join Us</a></p>
<?php
endSection();
