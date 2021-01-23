<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/public/css/style.css">
        <script type="text/javascript" src="/public/scripts/photo_comment.js" defer></script>
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>PHOTO PAGE</title>
    </head>
    <body>
        <div class="home-container">
            <?php 
                include("components/header.html");
            ?>
            <div class="home-content">
                <div class="photo-content-box">
                    <div class="photo-content-box-img">
                        <img src="/public/uploads/<?php echo $photo['image']; ?>">
                    </div>
                    <div class="photo-content-box-properties">
                        <div class="photo-properties-box">
                            <h1><?php echo $photo['nick']; ?></h1>
                            <p>DO ZMIANY</p>
                            <h2><?php echo $photo['likes'] ?></h2>
                            <form class="photo-add-comment" action="comment" method="POST">
                                <div class="login-message">
                                    <?php
                                        if(isset($messages))
                                            foreach ($messages as $message) {
                                                echo $message;
                                            }
                                    ?>
                                </div>
                                <input type="hidden" name="id_photo" value="<?php echo $photo['id_photo']; ?>">
                                <textarea id="comment" name="comment" placeholder="Add comment"></textarea>
                                <button type="submit">Dodaj</button>
                            </form>
                            <div class="photo-comments">
                                <?php if($comments != false)
                                    foreach($comments as $comment):
                                ?>
                                <div class="comment">
                                    <p class="author"><?php echo "@".$comment['nick']." - ".$comment['created_at']; ?></p>
                                    <p class="comment-content"><?php echo $comment['content']; ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>