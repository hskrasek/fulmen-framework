<?php namespace Fulmen;

use Fulmen\Container\IlluminateContainer;
use Illuminate\Container\Container;
use Psr\Container\ContainerInterface;

class Application
{
    private $container;

    public function __construct(Container $container, array $providers)
    {
        $this->container = $container;

        $this->setupBaseBindings();

        $this->registerProviders($providers);
    }

    private function setupBaseBindings(): void
    {
        $this->container->instance('app', $this);

        $this->container->instance(Container::class, $this->container);

        $this->container->instance(ContainerInterface::class, new IlluminateContainer($this->container));
    }

    private function registerProviders(array $providers) : void
    {
        foreach ($providers as $provider) {
            $serviceProvider = $this->container->make($provider);

            $serviceProvider->register();
        }
    }
}
