<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/11
 * Time: 下午11:44
 */

namespace Tetsuwan\Foundation;

class Application extends Container
{
    public function __construct()
    {
        static::setInstance($this);
        $this->init();
    }

    protected function init()
    {
        $this->initBind();
        $this->initSingleton();
    }

    protected function initBind()
    {
        $this->bind(\Tetsuwan\Contracts\Routing\Route::class, \Tetsuwan\Routing\Route::class);
    }

    protected function initSingleton()
    {
    }
}