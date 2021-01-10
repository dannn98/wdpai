<?php


class Route
{
    private $url;
    private $controller;
    private $action;
    private $method;

    public function __construct($url, $controller, $action, $method)
    {
        $this->url = $url;
        $this->controller = $controller;
        $this->action = $action;
        $this->method = $method;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getMethod()
    {
        return $this->method;
    }
}