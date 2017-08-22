<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/21
 * Time: 下午10:19
 */

namespace App;

use Tetsuwan\Http\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    protected $controllerNamespace = 'App\\Controller\\';
}