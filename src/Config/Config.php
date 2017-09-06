<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/9/6
 * Time: 下午10:51
 */

namespace Tetsuwan\Config;

use Tetsuwan\Contracts\Config\Config as ConfigContract;

class Config implements ConfigContract
{
    protected $path;

    protected $configs = [];

    public function __construct($path)
    {
        $this->path;
    }

    protected function initConfig()
    {
        foreach (scandir($this->path) as $item) {
            $extName = pathinfo($this->path . $item, PATHINFO_EXTENSION);
            if ('php' == $extName) {
                $configName = basename($this->path . $item, '.php');
                $config = require_once $this->path . $item;
                if (is_array($config)) {
                    $this->configs[$configName] = $config;
                }
            }
        }
    }

    public function getConfigItem($item)
    {
        $key = explode('.', $item);
        return $this->configs[$key[0]][$key[1]] ?? null;
    }
}