<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午5:30
 */

namespace Tetsuwan\Http;

use Tetsuwan\Contracts\Http\Kernel as KernelContract;
use Tetsuwan\Contracts\Http\Request;
use Tetsuwan\Contracts\Http\Response;
use swoole_http_response as SwooleResponse;
use Tetsuwan\Contracts\Routing\Route;
use Tetsuwan\Contracts\Routing\Router;
use Tetsuwan\Foundation\Container;

class Kernel implements KernelContract
{
    protected $app;

    protected $response;

    protected $request;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->app = Container::getInstance();
    }

    public function handle(Request $request, SwooleResponse $swResponse)
    {
        $this->response->setSwooleResponse($swResponse);

        $uri = $request->getUri();

        $uri = rtrim($uri, '/');

        $router = $this->app[Router::class];

        $route = $router->getRoute('get', $uri);

        $this->response->setRoute($route);

        return $this->response;
    }
}