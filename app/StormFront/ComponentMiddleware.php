<?php

namespace App\StormFront;

use Tempest\Container\Container;
use Tempest\Core\Priority;
use Tempest\Discovery\SkipDiscovery;
use Tempest\Http\Request;
use Tempest\Http\Response;
use Tempest\Router\HttpMiddleware;
use Tempest\Router\HttpMiddlewareCallable;
use Tempest\Router\MatchedRoute;

#[SkipDiscovery]
#[Priority(Priority::FRAMEWORK)]
final readonly class ComponentMiddleware implements HttpMiddleware
{
    public function __construct(
        private readonly Container $container,
    )
    {
    }

    public function __invoke(Request $request, HttpMiddlewareCallable $next): Response
    {
        $matchedRoute = $this->container->get(MatchedRoute::class);
        $route = $matchedRoute->route;

        if(! is_null($route->handler->getReturnType())) {
            return $next($request);
        }

        $this->container->invoke(
            $route->handler,
            ...$matchedRoute->params,
        );

        $class = $route->handler->getDeclaringClass();

        $matchedRoute->route->handler = $class->getMethod('render');

        return $next($request);
    }
}