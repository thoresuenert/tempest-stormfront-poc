<?php

namespace App\StormFront;

use Attribute;
use Tempest\Router\Route;
use Tempest\Router\RouteDecorator;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
final readonly class Component implements RouteDecorator
{
    public function decorate(Route $route): Route
    {
        $route->middleware[] = ComponentMiddleware::class;

        return $route;
    }
}