<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午11:07
 */

namespace Tetsuwan\Routing;

use Tetsuwan\Contracts\Routing\Route as RouteContract;

class Route implements RouteContract
{
    protected $action;

    public function setAction(callable $action)
    {
        if (is_callable($action)) {
            $this->action = $action;
        }
    }

    public function getAction()
    {
        return $this->action;
    }

    public function __invoke()
    {
        $args = func_get_args();
        return call_user_func_array($this->action, $args);
    }
}