<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/11
 * Time: 下午11:42
 */

namespace Tetsuwan\Foundation;

use Tetsuwan\Contracts\Foundation\Container as ContainerContract;

class Container implements ContainerContract, \ArrayAccess
{
    protected static $instance;

    protected $bindings = [];

    protected $instances = [];

    public function singleton($abstract, $concrete = null)
    {
        $this->bind($abstract, $concrete, true);
    }

    public function bind($abstract, $concrete = null, $shared = false)
    {
        unset($this->bindings[$abstract], $this->instances[$abstract]);

        if (!$concrete) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = [
            'concrete' => $concrete,
            'shared'   => $shared,
        ];

    }

    public function make($abstract)
    {
        if (!isset($this->bindings[$abstract])) {
            throw new \Exception("Try to find unexpected class {$abstract}.");
        }

        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $concrete = $this->bindings[$abstract]['concrete'];
        $shared = $this->bindings[$abstract]['shared'];

        if (is_callable($concrete)) {
            $instance = call_user_func($concrete, self::$instance);
            if ($shared) {
                $this->instances[$abstract] = $instance;
            }
            return $instance;
        }

        $class = new \ReflectionClass($concrete);
        if (!$class->getConstructor()) {
            return $class->newInstanceWithoutConstructor();
        }
        $parameters = $class->getConstructor()->getParameters();
        $buildStack = [];
        foreach ($parameters as $key => $parameter) {
            $instance = $this->make($parameter->getClass()->name);
            $buildStack[$key] = $instance;
        }

        if ($shared) {
            return $this->instances[$abstract] = $class->newInstanceArgs($buildStack);
        }

        return $class->newInstanceArgs($buildStack);
    }

    public static function getInstance()
    {
        return static::$instance;
    }

    public static function setInstance(Container $container)
    {
        self::$instance = $container;
    }

    public function offsetExists($offset)
    {
        return isset($this->bindings[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->instances[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        if (!isset($this->bindings[$offset]) || $this->bindings[$offset]['shared']) {
            $this->bind($offset, $value);
        } else {
            $this->singleton($offset, $value);
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->bindings[$offset], $this->instances[$offset]);
    }
}