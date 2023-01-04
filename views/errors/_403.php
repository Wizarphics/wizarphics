<?php
/*
 * Copyright (c) 2022.
 * User: Fesdam
 * project: WizarFrameWork
 * Date Created: $file.created
 * 6/30/22, 10:39 PM
 * Last Modified at: 6/30/22, 10:39 PM
 * Time: 10:39
 * @author Wizarphics <Wizarphics@gmail.com>
 *
 */
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <title>403::<?= $exception->getMessage() ?></title>
    <style>
        :root {
            --main-bg-color: #282c34;
            --main-text-color: #efefef;
            --dark-text-color: #222;
            --light-text-color: #c7c7c7;
            --primary-color: #ff0000;
            --light-bg-color: #efefef;
            --dark-bg-color: #404040;
        }

        body {
            height: 100%;
            background: var(--main-bg-color);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            color: var(--main-text-color);
            font-weight: 300;
            margin: 0;
            padding: 0;
        }

        h3 {
            font-weight: 300;
            letter-spacing: 0.8;
            font-size: 1.2rem;
            color: #c7c7c7;
            margin: 0;
        }

        .ASKPHP__trademark {
            position: absolute;
            bottom: 25px;
            right: 25px;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            font-weight: normal;
            gap: .3rem;
            color: #efefef;
        }
    </style>
</head>

<body>
    <a class="ASKPHP__trademark" href="<?= FRAME_WORK_URL ?>">
        <?= AskPHP_TRADE_MARK ?>
    </a>
    <div class="container" style="display: grid; place-content: center; height: 100vh;">
        <h3>
            403 | <?= $exception->getMessage() ?>
        </h3>
    </div>
</body>

</html>