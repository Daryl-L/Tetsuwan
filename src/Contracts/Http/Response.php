<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午5:04
 */

namespace Tetsuwan\Contracts\Http;

use swoole_http_response as SwooleResponse;
use Tetsuwan\Contracts\Routing\Route;

interface Response
{
    public function setSwooleResponse(SwooleResponse $swResponse);

    public function setContent(string $content);

    public function setRoute(Route $route);

    public function end();
}