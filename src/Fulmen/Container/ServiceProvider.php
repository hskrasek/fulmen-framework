<?php namespace Fulmen\Container;

use Illuminate\Contracts\Container\Container;

abstract class ServiceProvider
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function register(): void;
}
