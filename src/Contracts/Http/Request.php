<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午1:56
 */

namespace Tetsuwan\Contracts\Http;

use swoole_http_request as SwooleHttpRequest;

interface Request
{
    public function capture(SwooleHttpRequest $swRequest);

    public function getUri();
}