<?php
/*
 * Copyright (c) 2022.
 * User: Fesdam
 * project: WizarFrameWork
 * Date Created: $file.created
 * 6/30/22, 8:37 PM
 * Last Modified at: 6/30/22, 8:37 PM
 * Time: 8:37
 * @author Wizarphics <Wizarphics@gmail.com>
 *
 */

?>
<header class="mb-5">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-default fixed-top py-3">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo.png" alt="<?= env('app.name') ?> Logo" height="30px">
                <small class="ms-2 fw-bolder"><?= env('app.name') ?></small>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <a class="navbar-brand" href="/">
                        <img src="/images/logo.png" alt="<?= env('app.name') ?> Logo" height="30px">
                        <small class="ms-2 fw-bolder"><?= env('app.name') ?></small>
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav m-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route_to('about') ?>" title="About">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route_to('blog') ?>" title="Blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route_to('works') ?>" title="Works">Works</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-md-0 gap-3 align-items-center">
                        <li class="nav-item">
                            <a class="btn btn-primary rounded-pill" href="<?= route_to('talk') ?>">Talk to us</a>
                        </li>|
                        <?php if (auth()->isGuest()) : ?>
                            <li class="nav-item">
                                <a class="btn btn-outline-primary rounded-pill" href="<?= route_to('login') ?>">Login</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="btn btn-outline-primary rounded-pill" href="<?= route_to('login') ?>">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>