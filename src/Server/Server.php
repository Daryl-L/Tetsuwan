<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 上午11:33
 */

namespace Tetsuwan\Server;

use Tetsuwan\Contracts\Server\Server as ServerContract;
use swoole_server as SwooleServer;
use Tetsuwan\Foundation\Container;

abstract class Server implements ServerContract
{
    protected $app;

    protected $server;

    public function __construct(SwooleServer $server)
    {
        $this->server = $server;
        $this->app = Container::getInstance();
        $this->init();
    }

    abstract public function init();
}