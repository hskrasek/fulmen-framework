<?php namespace Fulmen\Routing;

use FastRoute\DataGenerator;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use FastRoute\RouteParser;
use FastRoute\RouteParser\Std;
use Fulmen\Container\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->bind(RouteParser::class, Std::class);

        $this->container->bind(DataGenerator::class, DataGenerator\GroupCountBased::class);

        $this->container->singleton(Dispatcher::class, function () {
            return new Dispatcher\GroupCountBased($this->container->make(RouteCollector::class)->getData());
        });

        // Add way to bind route collector to the container, load, and register routes using this bound route collector
    }
}
