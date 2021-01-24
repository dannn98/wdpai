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
            <?php 
                include("components/header.html");
            ?>
            <div class="home-content">
                <div class="upload-box">
                    <p>Upload your photo</p>
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