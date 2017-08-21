<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午1:56
 */

namespace Tetsuwan\Http;

use Tetsuwan\Contracts\Http\Request as RequestContract;
use swoole_http_request as SwooleHttpRequest;

class Request implements RequestContract
{
    protected $server = [];

    protected $get = [];

    protected $post = [];

    protected $header = [];

    public function capture(SwooleHttpRequest $request)
    {
        $this->server = $request->server ?? [];

        $this->get = $request->get ?? [];

        $this->post = $request->post ?? [];

        $this->header = $request->header ?? [];
    }

    public function getUri()
    {
        return $this->server['request_uri'];
    }
}