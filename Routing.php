<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/routing/Route.php';
require_once 'src/routing/RouteCollection.php';

class Routing {
    public static RouteCollection $routes;

    public static function route($url, $view, $action, $method) {
        $route = new Route($url, $view, $action, $method);
        self::$routes->addRoute($route);
    }

    public static function run($url) {
        $action = explode("/", $url)[0];

        foreach (self::$routes as $route) {
            if($route->getUrl() == $action && $route->getMethod() == $_SERVER['REQUEST_METHOD']) {

                $controller = $route->getController();
                $object = new $controller(explode("/", $url));
                $action = $route->getAction() ?: 'index';

                $object->$action();
                return;
            }
        }

        die("Wrong url!");
    }

    public static function init($routeCollection) {
        self::$routes = $routeCollection;
    }
}