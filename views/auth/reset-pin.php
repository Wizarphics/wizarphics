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
print '<small class="pb-5">Enter the code sent to your email below.</small>';
endSection(); ?>
<?php
section('form');
?>
<?php form_begin(route_to('reset-email'), 'post') ?>
<div class="row row-cols-5 mb-3">
    <input type="hidden" name="pin" id="pin">
    <?php
    for ($i = 0; $i < 5; $i++) {
    ?>
        <div class="col">
            <input type="text" data-name="code" maxlength="1" class="input-pin form-control" required>
        </div>
    <?php
    }
    ?>
</div>
<?= submit_button($model, 'Verify', ['class' => 'w-100 btn-danger']) ?>
<?= form_close() ?>
<?php
endSection();
?>