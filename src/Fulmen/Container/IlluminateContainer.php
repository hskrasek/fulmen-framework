<?php namespace Fulmen\Container;

use Illuminate\Contracts\Container\Container;
use Psr\Container\ContainerInterface;

class IlluminateContainer implements ContainerInterface
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function get($id)
    {
        return $this->container->make($id);
    }

    /**
     * @inheritDoc
     */
    public function has($id)
    {
        if (!class_exists($id)) {
            return false;
        }

        try {
            return (new \ReflectionClass($id))->isInstantiable();
        } catch (\ReflectionException $e) {
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    function __call($name, $arguments)
    {
        return $this->container->$name($arguments);
    }
}
