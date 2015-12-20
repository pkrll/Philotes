<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="<?=APP_DESCRIPTION?>">
        <meta name="keywords" content="<?=APP_NAME?>">
        <title><?=APP_NAME?></title>
        <link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:300,200' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/public/css/master.css" media="screen" charset="utf-8">
    </head>
    <body>
        <?php
            if (isset($error)) {
        ?>
        <div id="error">Error: <?=$error["message"]?></div>
        <?php
            }
        ?>
        <div id="topMenu">
            <div style="color:#12aade;"><?=APP_NAME?> <sup style="font-size: 13px"><?=APP_DEVELOPMENT_STAGE?></sup></div>
            <div><a href="/twitter/">Twitter</a></div>
            <div><a href="/facebook"/>Facebook</a></div>
            <div><a href="/instagram/">Instagram</a></div>
            <div><a href="/linkedin/">LinkedIn</a></div>
        </div>
        <div class="content">
