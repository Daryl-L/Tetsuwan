<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 上午11:34
 */

namespace Tetsuwan\Server\Http;

use Tetsuwan\Contracts\Http\Kernel;
use Tetsuwan\Contracts\Http\Request;
use Tetsuwan\Contracts\Http\Response;
use Tetsuwan\Server\Server as ServerBase;
use swoole_http_request as SwooleRequest;
use swoole_http_response as SwooleResponse;

class Server extends ServerBase
{
    public function init()
    {
        $this->server->on('request', [$this, 'onRequest']);
    }

    public function onRequest(SwooleRequest $swRequest, SwooleResponse $swResponse)
    {
        $request = $this->app->make(Request::class);
        $request->capture($swRequest);
        $kernel = $this->app->make(Kernel::class);
        $response = $kernel->handle($request, $swResponse);
        $response->end();
    }

    public function __call($name, $args)
    {
        if (is_callable([$this->server, $name])) {
            call_user_func_array([$this->server, $name], $args);
        }
    }
}