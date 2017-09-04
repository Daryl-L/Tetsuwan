<?php

$app = \Tetsuwan\Foundation\Container::getInstance();

if (!function_exists('app')) {
    function app($abstract)
    {
        global $app;
        return $app[$abstract];
    }
}
