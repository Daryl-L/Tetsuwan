<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午11:37
 */

namespace Tetsuwan\Routing;

use Tetsuwan\Contracts\Routing\Router as RouterContract;
use Tetsuwan\Foundation\Container;

class Router implements RouterContract
{
    protected $app;

    protected $routes = [];

    public function __construct()
    {
        $this->app = Container::getInstance();
    }

    public function get(string $uri, $action)
    {
        $route = $this->app->make(\Tetsuwan\Contracts\Routing\Route::class);

        if ($action instanceof \Closure) {
            $route->setAction($action);
        }

        $this->routes['get'][$uri] = $route;
    }

    public function getRoute($method, $uri)
    {
        if (isset($this->routes[$method][$uri])) {
            return $this->routes[$method][$uri];
        }
    }
}