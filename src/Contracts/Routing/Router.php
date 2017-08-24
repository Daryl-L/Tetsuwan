<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午11:37
 */

namespace Tetsuwan\Contracts\Routing;


interface Router
{
    public function get(string $uri, $action);

    public function setNamespace(string $namespace);

    public function getRoute($method, $uri);
}