<?php require '../vendor/autoload.php'; ?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Making the Internet">

        <title>Laravel 5 Contract Reference - Cheat Sheet</title>

        <link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="" rel="shortcut icon">
        <link href="" rel="apple-touch-icon-precomposed">
        <link rel='stylesheet' href="css/style.css"/>
    </head>
    <body>
        <div class="container">
            <div class="ui stackable grid">
                <div class="eight wide column">
                    <div class="ui dividing blue site header">
                        <div class="content">Laravel 5 Contracts</div>
                    </div>
                </div>
                <div class="eight wide column">
                    <div class="ui top search">
                        <div class="ui icon input">
                            <input type="text" placeholder="filter by keyword" class="prompt">
                            <i class="search icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?=(new LC\Presenters\GroupPresenter())->getHtml('group.twig')?>
            <div class="overlay"></div>
        </div>
        <script src="js/script.js"></script>
    </body>
</html>