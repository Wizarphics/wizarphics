<?php

/**
 * @var \wizarphics\wizarframework\View $this
 * @var string $type
 */
$this->title = __('Auth.reset_title');
section('pageHeading');
print '<h4>Successful</h4>';
endSection(); ?>
<?php
section('form');
print '<p class="text-center">'.__("Auth.$type-delivered").'</p>';
?>

<?php
endSection();
