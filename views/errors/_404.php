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
    <title>404::<?= $exception->getMessage() ?></title>
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
        <svg height="20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 75 45.62">
            <defs>
                <style>
                    .cls-1 {
                        fill: #fff;
                    }
                </style>
            </defs>
            <g id="Layer_2" data-name="Layer 2">
                <g id="WFM_LOGO" data-name="WFM LOGO">
                    <g id="AI_Image.psd">
                        <image id="AI_Image" width="270" height="276" transform="translate(27.96 28.24) scale(0.06)" xlink:href="data:image/png;base64,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" />
                    </g>
                    <path class="cls-1" d="M23,8.38v3.31L3,20.51l20,8.88V32.7L0,22.44v-3.8Z" />
                    <path class="cls-1" d="M25.42,12.2q.1-5.79,3.43-9t9-3.2a16.2,16.2,0,0,1,6.3,1.12,9.14,9.14,0,0,1,4.1,3.27,9.08,9.08,0,0,1,1.47,5.28A9.21,9.21,0,0,1,49,13.41a10.22,10.22,0,0,1-1.82,2.81,28.29,28.29,0,0,1-2.37,2.28c-.82.71-1.61,1.43-2.36,2.16a9.55,9.55,0,0,0-1.82,2.42,6.53,6.53,0,0,0-.71,3.12H33.46a10.76,10.76,0,0,1,.59-3.82,10.18,10.18,0,0,1,1.52-2.76,16.73,16.73,0,0,1,2-2.13c.7-.64,1.35-1.27,2-1.89a8.57,8.57,0,0,0,1.52-2A5.48,5.48,0,0,0,41.61,11,3.76,3.76,0,0,0,40.43,7.9a5,5,0,0,0-3.32-1,4.94,4.94,0,0,0-3.65,1.29,5.54,5.54,0,0,0-1.35,4Z" />
                    <path class="cls-1" d="M52,32.54V29.23l20-8.82L52,11.53V8.22L75,18.48v3.8Z" />
                </g>
            </g>
        </svg>
        AskPHP
    </a>
    <div class="container" style="display: grid; place-content: center; height: 100vh;">
        <h3>
            404 | <?= $exception->getMessage() ?>
        </h3>
    </div>
</body>

</html>