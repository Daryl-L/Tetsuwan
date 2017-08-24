<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午11:07
 */

namespace Tetsuwan\Contracts\Routing;


use Tetsuwan\Contracts\Http\Request;

interface Route
{
    public function setRequest(Request $request);

    public function setAction($action);

    public function getAction();

    public function setController($controller);
}