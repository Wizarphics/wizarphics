<section class="py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-5">
                <h1 class="fw-semibold display-3">Talk to a <span class="text-primary">human</span>, let’s talk.</h1>
                <p class="px-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nulla, quod eum aperiam et qui rem.</p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 card p-5 border-light shadow rounded-4 bg-dark">
                <?php form_begin('letsTalk', 'post') ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= emailField($model, 'email', ['placeholder' => 'Email address', 'labelClass' => 'ps-3 text-light', 'class' => 'rounded-4']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= emailField($model, 'companyEmail', ['placeholder' => 'Company email', 'labelClass' => 'ps-3 text-light', 'class' => 'rounded-4']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= textField($model, 'companyName', ['placeholder' => 'Company name', 'labelClass' => 'ps-3 text-light', 'class' => 'rounded-4']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= numberField($model, 'phone', ['placeholder' => 'Phone number', 'labelClass' => 'ps-3 text-light', 'class' => 'rounded-4']) ?>
                    </div>
                    <?= textAreaField($model, 'message', ['placeholder' => 'Lets know how we can assist you...', 'labelClass' => 'ps-3 text-light', 'class' => 'rounded-4']) ?>
                    <?= submit_button($model, 'submit', ['class' => 'rounded-4 btn btn-block w-100', 'superClass' => 'mt-5']) ?>
                </div>
                <?php form_close() ?>
            </div>
        </div>
</section>