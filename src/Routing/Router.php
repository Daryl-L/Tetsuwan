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

    protected $namespace;

    public function __construct()
    {
        $this->app = Container::getInstance();
    }

    public function get(string $uri, $action)
    {
        $this->createRoute($uri, $action, 'get');
    }

    protected function createRoute(string $uri, $action, string $method)
    {
        /** @var \Tetsuwan\Contracts\Routing\Route $route */
        $route = $this->app->make(\Tetsuwan\Contracts\Routing\Route::class);

        if ($action instanceof \Closure) {
            $route->setAction($action);
        } elseif (is_string($action)) {
            [$controller, $action] = $this->parseAction($action);
            $route->setController($controller);
            $route->setAction($action);
        }

        $this->routes[$method][$uri] = $route;
    }

    protected function parseAction($action)
    {
        [$controller, $action] = explode('@', $action);
        $controller = $this->namespace . ltrim($controller, '\\');

        return [$controller, $action];
    }

    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;
    }

    public function getRoute($method, $uri)
    {
        if (isset($this->routes[$method][$uri])) {
            return $this->routes[$method][$uri];
        }
    }
}