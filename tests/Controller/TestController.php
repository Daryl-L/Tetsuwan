<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/22
 * Time: 下午11:18
 */

namespace App\Controller;


use Tetsuwan\Contracts\Http\Request;

class TestController
{
    public function test(Request $request)
    {
        return $request->getUri();
    }
}