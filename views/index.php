<section>
    <div class="container">
        <div class="row pt-5 justify-content-between">
            <div class="col-md-6 col-lg-6">
                <h1 class="fw-semibold display-3">Let's Bring Your Next <span class="text-primary">Biggest</span> Ideas <span class="text-primary">To</span> Live.</h1>
                <p>It always gets better with a website.</p>
            </div>
            <div class="col-md-3 col-lg-4">
                <div class="things">
                    <div class="content">
                        <div class="arrow">
                            <div class="curve"></div>
                            <div class="point"></div>
                        </div>
                    </div>
                    <div class="content">
                        <h1>Let's Talk.</h1>
                        <p>Click the button above.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="clients&Partners">
    <div class="container">
        <marquee behavior="scroll" direction="left" height="45px" hspace="50px">
            <img src="/images/clients/kinly.png" alt="Kinly" title="Kinly Logo" class="client">
            <img src="/images/clients/republic.png" alt="Republic" title="Republic Logo" class="client">
            <img src="/images/clients/revancex.png" alt="RevanceX" title="RevanceX Logo" class="client">
            <img src="/images/clients/trove.png" alt="Trove" title="Trove Logo" class="client">
            <img src="/images/clients/fesdam.png" alt="Fesdam" title="Fesdam Logo" class="client">
        </marquee>
    </div>
</section>

<section>
    <div class="container">
        <div class="row pt-5 justify-content-between">
            <div class="col-md-4 col-lg-4 pt-5">
                <h1 class="fw-semibold display-5">Why you should work with <span class="text-primary">us</span>.</h1>
                <a title="Let's Talk" class="btn btn-primary rounded-pill" href="<?= route_to('talk') ?>" role="button">Let's Talk</a>
            </div>
            <div class="col-md-9 col-lg-8 row gap-4">
                <div class="feature col-md-5 card border-0 shadow-sm p-4">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3 bg-dark text-dark bg-gradient bg-opacity-10">
                        <i class="bi bi-chat"></i>
                    </div>
                    <h3 class="fs-2">Quick support team</h3>
                    <p>A dynamic array of layouts that empower you to create eye-catching websites.</p>
                </div>
                <div class="feature col-md-5 card border-0 shadow-sm p-4">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3 bg-dark text-dark bg-gradient bg-opacity-10">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3 class="fs-2">Work on schedule</h3>
                    <p>A dynamic array of layouts that empower you to create eye-catching websites.</p>
                </div>
                <div class="feature col-md-5 card border-0 shadow-sm p-4">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3 bg-dark text-dark bg-gradient bg-opacity-10">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <h3 class="fs-2">Work on budget</h3>
                    <p>A dynamic array of layouts that empower you to create eye-catching websites.</p>
                </div>
                <div class="feature col-md-5 card border-0 shadow-sm p-4">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3 bg-dark text-dark bg-gradient bg-opacity-10">
                        <i class="bi bi-fingerprint"></i>
                    </div>
                    <h3 class="fs-2">Keep your data secure</h3>
                    <p>A dynamic array of layouts that empower you to create eye-catching websites.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php section('css') ?>
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="/css/swiper-bundle.min.css" />
<style>
    .swiper {
        width: 500px;
        height: 320px;
    }

    .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
    }
</style>
<?php endSection() ?>
<section class="mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h1 class="fw-semibold display-5">What people are saying <span class="text-primary">about us</span>.</h1>
            </div>
            <div class="col-md-8">
                <!-- Swiper -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <div class="swiper-slide card shadow-sm border-0">
                                <div class="card-header w-100">
                                    <div class="row justify-content-between">
                                        <div class="col-md-4">
                                            <p style="font-size: 14px; margin: 0;" class="fw-medium">Review by Fesdam</p>
                                            <small style="font-size: 10px;">
                                                <i class="bi bi-star-fill text-primary"></i>
                                                <i class="bi bi-star-fill text-primary"></i>
                                                <i class="bi bi-star-fill text-primary"></i>
                                                <i class="bi bi-star-fill text-primary"></i>
                                                <i class="bi bi-star-fill text-primary"></i>
                                            </small>
                                        </div>
                                        <div class="col-md-5">
                                            <img src="/images/clients/fesdam.png" alt="" height="45" class="client">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body w-100 p-5">
                                    <h4 class="card-title">Lorem ipsum dolor sit amet.</h4>
                                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis eum voluptatem harum? Error, rem voluptas.</p>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php section('js') ?>
<!-- Swiper JS -->
<script src="/js/swiper-bundle.min.js"></script>
<?php endSection() ?>

<?php section('js') ?>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        effect: "cards",
        grabCursor: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false
        }
    });
</script>
<?php endSection() ?>