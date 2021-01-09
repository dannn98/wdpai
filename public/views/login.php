<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>LOGIN PAGE</title>
    </head>
    <body>
        <div class="login-container">
            <div class="login-logo">
                <img src="public/img/logo-white.svg">
            </div>
            <div class="login-form">
                <form action="login" method="POST">
                    <div class="login-message">
                        <?php
                            if(isset($messages))
                                foreach ($messages as $message) {
                                    echo $message;
                                }
                        ?>
                    </div>
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                    <button type="submit">LOGIN</button>
                    <p>Don't have an account? <a href="/home">Create account here</a></p>
                </form>
            </div>
        </div>
    </body>
</html>