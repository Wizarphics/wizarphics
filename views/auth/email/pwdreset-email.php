<?php
section('content'); ?>

<tr>
    <td>
        <p>Hi <?= $name ?>,</p>
        <p>Somebody requested a new password for the <?= env('app.name') ?> account associated with <?= $email ?>.</p>
        <p>No changes have been made to your account yet.</p>
        <p>You can reset your password by clicking the link below:</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
            <tbody>
                <tr>
                    <td align="left">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <?= $link ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>If you did not request a new password, please let us know immediately by replying to this email.</p>
        <p><?= "The " . env('app.name') . " team" ?></p>
    </td>
</tr>

<?php
endSection();
