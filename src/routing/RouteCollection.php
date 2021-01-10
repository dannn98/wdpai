<?php


class RouteCollection implements IteratorAggregate
{
    private $collection = [];

    public function getIterator()
    {
        return new ArrayIterator($this->collection);
    }

    public function addRoute($route) {
        $this->collection[] = $route;
    }
}