<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/public/css/style.css">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>PHOTO PAGE</title>
    </head>
    <body>
        <div class="home-container">
            <header>
                <div class="home-header-top">
                    <div class="home-header">
                        <img src="/public/img/logo-white.svg">
                        <div class="home-header-panel">
                            <a href="/profil"><img src="/public/img/user.svg"></a>
                            <a href="/logout"><img src="/public/img/logout.svg"></a>
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
                <div class="photo-content-box">
                    <div class="photo-content-box-img">
                        <img src="/public/uploads/<?php echo $photo['image']; ?>">
                    </div>
                    <div class="photo-content-box-properties">
                        <div class="photo-properties-box">
                            <h1><?php echo $photo['nick']; ?></h1>
                            <p>DO ZMIANY</p>
                            <h2><?php echo $photo['likes'] ?></h2>
                            <form class="photo-add-comment">
                                <textarea name="comment" placeholder="Add comment"></textarea>
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