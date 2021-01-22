<?php

require_once 'src/routing/Route.php';
require_once 'src/routing/RouteCollection.php';
require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/PhotoController.php';
require_once 'src/AuthenticationGuard.php';

class Routing {
    public static RouteCollection $routes;

    public static function route($url, $view, $action, $method) {
        $route = new Route($url, $view, $action, $method);
        self::$routes->addRoute($route);
    }

    public static function run($url) {
        $action = explode("/", $url)[0];

        //One to one
        foreach (self::$routes as $route) {
            if($route->getUrl() == $action && $route->getMethod() == $_SERVER['REQUEST_METHOD']) {
                AuthenticationGuard::checkAuthentication($action);

                $controller = $route->getController();
                $object = new $controller(explode("/", $url));
                $action = $route->getAction() ?: 'home';

                $object->$action();
                return;
            }
        }

        $URL_parts = explode("/", $url);
        $URL_size = count($URL_parts);
        foreach(self::$routes as $route) {
            $isEqual = true;
            $action = "";
            $URL_parts_yaml = explode("/", $route->getUrl());
            if(count($URL_parts_yaml) == $URL_size && $route->getMethod() == $_SERVER['REQUEST_METHOD']){
                for($i = 0; $i < $URL_size; $i++) {
                    if($URL_parts[$i] == $URL_parts_yaml[$i]) {
                        $action = $action.$URL_parts_yaml[$i];
                    }
                    else {
                        $isEqual = false;
                        break;
                    }
                }
                if($isEqual) {
                    AuthenticationGuard::checkAuthentication($action);

                    $controller = $route->getController();
                    $object = new $controller(explode("/", $url));
                    $action = $route->getAction() ?: 'home';

                    $object->$action();
                    return;
                }
            }
        }

        http_response_code(404);
    }

    public static function init($routeCollection) {
        self::$routes = $routeCollection;
    }
}