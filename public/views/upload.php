<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
       <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>UPLOAD PAGE</title>
    </head>
    <body>
        <div class="home-container">
            <header>
                <div class="home-header-top">
                    <div class="home-header">
                        <img src="public/img/logo-white.svg">
                        <div class="home-header-panel">
                            <a href="/profil"><img src="public/img/user.svg"></a>
                            <a href="/logout"><img src="public/img/logout.svg"></a>
                        </div> 
                    </div>
                </div>
                <div class="home-header-bottom">
                    <nav class="home-nav">
                        <a href="/home">HOME</a>
                        <a href="/">PEOPLE</a>
                        <a href="/photo">FOLDERS</a>
                    </nav>
                </div>
            </header>
            <div class="home-under-header"></div>
            <div class="home-content">
                <div class="upload-box">
                    <h1>Upload photo</h1>
                    <form action="upload" method="POST" enctype="multipart/form-data">
                        <div class="login-message">
                            <?php
                                if(isset($messages))
                                    foreach ($messages as $message) {
                                        echo $message;
                                    }
                            ?>
                        </div>
                        <input name="title" type="text" placeholder="title">
                        <input name="file" type="file">
                        <button type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>