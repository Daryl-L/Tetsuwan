<?php

$app = \Tetsuwan\Foundation\Container::getInstance();

if (!function_exists('app')) {
    function app($abstract)
    {
        global $app;
        return $app[$abstract];
    }
}

if (!function_exists('config')) {
    function config($item)
    {
        global $app;
        $config = app('config');
        return $config->getConfigItem($item);
    }
}
