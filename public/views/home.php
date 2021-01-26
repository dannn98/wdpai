<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <script type="text/javascript" src="/public/scripts/home.js" defer></script>
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>HOME PAGE</title>
    </head>
    <body>
        <div class="home-container">
            <?php
                include("components/header.html");
            ?>
            <div class="home-content">
                <div class="home-content-box">
                    <div id="loader"></div>
                    <div class="home-content-box-col animate-bottom" id="col-1">

                    </div>
                    <div class="home-content-box-col animate-bottom" id="col-2">

                    </div>
                    <div class="home-content-box-col animate-bottom" id="col-3">

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<template id="photo-template">
    <div class="home-content-box-photo">
        <div class="home-content-box-photo-title"></div>
        <a href="/photo/id">
            <div class="home-content-box-photo-img">
                <img src="public/uploads/1.jpg">
            </div>
        </a>
        <div class="home-content-box-photo-info">
            <p class="home-name">Nick</p>
            <p class="home-likes">943</p>
            <p class="home-type">Model</p>
            <p class="home-comments">41</p>
        </div>
    </div>
</template>