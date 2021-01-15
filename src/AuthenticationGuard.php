<?php

require_once __DIR__.'/models/User.php';

class AuthenticationGuard
{
    private static $protectedViews = [];

    public static function authenticateUser(User $user) {
        setcookie("user", $user->getNick(), time() + (86400 * 7), "/");
    }

    public static function cancelAuthentication() {
        setcookie("user", "", 0);
    }

    public static function protectURL(array $views) {
        self::$protectedViews = $views;
    }

    public static function getAuthenticatedNick() {
        if(isset($_COOKIE['user'])) {
            return $_COOKIE['user'];
        }
    }

    public static function checkAuthentication($url) {
        if(in_array($url, self::$protectedViews) and !isset($_COOKIE['user'])) {
            self::redirect('login');
        }

        if(isset($_COOKIE['user']) and ($url === 'login' or $url === 'register')) {
            self::redirect('home');
        }
    }

    private static function redirect($direct) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/{$direct}");
    }
}