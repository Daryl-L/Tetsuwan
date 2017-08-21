<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Tetsuwan\Foundation\Application();

$app->bind('swoole_server', function ($app) {
    $swooleServer = new swoole_http_server('127.0.0.1', 9501);
    return $swooleServer;
});

$app->singleton(\Tetsuwan\Server\Http\Server::class);
$server = $app->make(\Tetsuwan\Server\Http\Server::class);

$app->bind(
    \Tetsuwan\Contracts\Http\Request::class,
    \Tetsuwan\Http\Request::class
);

$app->bind(
    \Tetsuwan\Contracts\Http\Response::class,
    \Tetsuwan\Http\Response::class
);

$app->bind(
    \Tetsuwan\Contracts\Http\Kernel::class,
    \Tetsuwan\Http\Kernel::class
);

//$app->singleton(
//    \Tetsuwan\Contracts\Routing\Router::class,
//    \Tetsuwan\Routing\Router::class
//);
//
$router = $app->make(\Tetsuwan\Contracts\Routing\Router::class);

$router->get('/test', function () {
    return 2333;
});

$server->start();
