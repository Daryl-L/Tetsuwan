<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/20
 * Time: 下午5:03
 */

namespace Tetsuwan\Http;

use Tetsuwan\Contracts\Http\Response as ResponseContract;
use swoole_http_response as SwooleResponse;
use Tetsuwan\Contracts\Routing\Route;

class Response implements ResponseContract
{
    const HTTP_CONTINUE = 100;
    const HTTP_SWITCHING_PROTOCOLS = 101;

    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_NO_CONTENT = 204;
    const HTTP_CONTENT_RESET = 205;
    const HTTP_PARTIAL_CONTENT = 206;

    protected $statusTexts = [
        200 => 'OK',
    ];

    protected $swResponse;

    protected $headers = [];

    protected $cookies = [];

    protected $statusCode = self::HTTP_OK;

    protected $description;

    protected $content;

    protected $route;

    public function setSwooleResponse(SwooleResponse $swResponse)
    {
        $this->swResponse = $swResponse;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function setRoute(Route $route)
    {
        $this->route = $route;
    }

    public function end()
    {
        $this->content = call_user_func($this->route);

        foreach ($this->headers as $key => $header) {
            $this->swResponse->header($key, $header);
        }

        $this->swResponse->status($this->statusCode);

        $this->swResponse->gzip();

        $this->swResponse->end($this->content ?? '');
    }
}