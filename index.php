<?php

require 'Routing.php';
require_once 'src/routing/RouteCollection.php';
require_once 'src/AuthenticationGuard.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::init(new RouteCollection());

Routing::route('', 'DefaultController', '', 'GET');
Routing::route('index', 'DefaultController', '', 'GET');
Routing::route('login', 'DefaultController', 'login', 'GET');
Routing::route('login', 'SecurityController', 'login', 'POST');

Routing::route('register', 'DefaultController', 'register', 'GET');
Routing::route('register', 'SecurityController', 'register', 'POST');

Routing::route('home', 'DefaultController', 'home', 'GET');
Routing::route('photos', 'PhotoController', 'photos', 'GET');
Routing::route('photo', 'PhotoController', 'photo', 'GET');
Routing::route('like', 'PhotoController', 'like', 'POST');
Routing::route('photo/comment', 'PhotoController', 'addComment', 'POST');

Routing::route('upload', 'DefaultController', 'upload', 'GET');
Routing::route('upload', 'PhotoController', 'upload', 'POST');

Routing::route('logout', 'SecurityController', 'logout', 'GET');

AuthenticationGuard::protectURL(['', 'index','home', 'upload', 'photo','photo/comment']);

Routing::run($path);