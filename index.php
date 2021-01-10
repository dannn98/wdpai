<?php

require 'Routing.php';
require_once 'src/routing/RouteCollection.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::init(new RouteCollection());

Routing::route('', 'DefaultController', '', 'GET');
Routing::route('index', 'DefaultController', 'index', 'GET');
Routing::route('register', 'DefaultController', 'register', 'GET');
Routing::route('home', 'DefaultController', 'home', 'GET');
Routing::route('photo', 'DefaultController', 'photo', 'GET');
Routing::route('login', 'SecurityController', 'login', 'GET');
Routing::route('login', 'SecurityController', 'login', 'POST');
Routing::route('register', 'SecurityController', 'register', 'POST');

Routing::run($path);