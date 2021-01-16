<?php

require_once __DIR__.'/models/User.php';
require_once __DIR__.'/repository/TokenRepository.php';

class AuthenticationGuard
{
    private static $protectedViews = [];
    private static Repository $tokenRepository;

    public static function authenticateUser(int $id_user) {
        $key = uniqid();

        self::$tokenRepository->addToken($key, $id_user);
        setcookie("mstory-token", $key, time() + (86400 * 7), "/");
    }

    public static function cancelAuthentication() {
        self::$tokenRepository->delToken($_COOKIE['mstory-token']);
        setcookie("mstory-token", "", 0);
    }

    public static function protectURL(array $views) {
        self::$protectedViews = $views;
        self::$tokenRepository = new TokenRepository();
    }

    public static function checkAuthentication($url) {
        if(in_array($url, self::$protectedViews) and (!isset($_COOKIE['mstory-token']) or !self::validateCookie())) {
            self::redirect('login');
        }

        if(($url === 'login' or $url === 'register') and (isset($_COOKIE['mstory-token']) and self::validateCookie())) {
            self::redirect('home');
        }
    }

    public static function getCurrentUserId(): ?int {
        return self::$tokenRepository->getUserId($_COOKIE['mstory-token']);
    }

    private static function validateCookie(): bool {
        return self::$tokenRepository->checkToken($_COOKIE['mstory-token']);
    }

    private static function redirect($direct) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/{$direct}");
    }
}