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