<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午11:07
 */

namespace Tetsuwan\Routing;

use Tetsuwan\Contracts\Http\Request;
use Tetsuwan\Contracts\Routing\Route as RouteContract;

class Route implements RouteContract
{
    protected $action;

    protected $controller;

    protected $request;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getAction()
    {
        if (is_callable($this->action)) {
            return $this->action;
        } else {
            $controllerClass = new \ReflectionClass($this->controller);
            return [$controllerClass->newInstance(), $this->action];
        }
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function __invoke()
    {
        $args = func_get_args();
        if (is_callable($this->action)) {
            return call_user_func_array($this->action, $args);
        } else {
            $controllerClass = new \ReflectionClass($this->controller);
            $method = $controllerClass->getMethod($this->action);
            $parameters = $method->getParameters();
            $parameterStack = [];
            foreach ($parameters as $parameter) {
                if (Request::class == $parameter->getClass()->name) {
                    $parameterStack[] = $this->request;
                    continue;
                }

                $parameterStack[] = $this->app->mane($parameter->getClass());
            }
            return call_user_func_array([$controllerClass->newInstance(), $this->action], $parameterStack);
        }
    }
}