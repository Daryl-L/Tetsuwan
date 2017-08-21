<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/11
 * Time: 下午11:51
 */

use Tetsuwan\Foundation\Container;

class ContainerTest extends PHPUnit\Framework\TestCase
{
    public function testInstance()
    {
        Container::setInstance(new Container);

        $this->assertInstanceOf(\Tetsuwan\Contracts\Foundation\Container::class, Container::getInstance());
    }

    public function testSingleton()
    {
        $container = new Container;

        $container->singleton('stdClass', StdClass::class);
        $this->assertInstanceOf(StdClass::class, $container['stdClass']);

        $container->singleton(StdClass::class);
        $this->assertInstanceOf(StdClass::class, $container[StdClass::class]);
    }

    public function testMake()
    {
        $container = new Container;

        $container->bind(B::class);
        $container->singleton(A::class);

        $this->assertInstanceOf(A::class, $container[A::class]);
    }
}

class A
{
    public function __construct(B $b)
    {
        
    }
}

class B
{

}