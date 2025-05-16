<?php
function get_passwords($filename)
{
    $passwords = [];

    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line)
    {
        list($user, $pass) = explode('*', trim($line));
        $passwords[$user] = $pass;
    }

    return $passwords;
}

function show_color_page($color)
{
    $colors = [
        'piros'   => '#FF0000',
        'zold'    => '#00FF00',
        'sarga'   => '#FFFF00',
        'kek'     => '#0000FF',
        'fekete'  => '#000000',
        'feher'   => '#FFFFFF'
    ];

    $bg_color = $colors[$color] ?? '#FFFFFF';
    $text_color = ($color == 'fekete' || $color == 'kek') ? 'white' : 'black';
    ?>
    <!DOCTYPE html>
    <html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Magyar Levente JKTFEX - Kedvenc színed</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: <?= $bg_color ?>;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                color: <?= $text_color ?>;
                text-align: center;
            }
            .container {
                max-width: 600px;
                width: 90%;
                padding: 30px;
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }
            h1 {
                font-size: 2.2rem;
                margin-bottom: 30px;
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
            }
            .circle {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                margin: 30px auto;
                background: <?= $bg_color ?>;
                border: 3px solid <?= $text_color ?>;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                transition: transform 0.3s;
            }
            .circle:hover {
                transform: scale(1.05);
            }
            .footer {
                margin-top: 40px;
                font-size: 0.9rem;
                opacity: 0.8;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Sikeres bejelentkezés!</h1>
            <p>szín: <strong><?= ucfirst($color) ?></strong></p>
            <div class="circle"></div>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>