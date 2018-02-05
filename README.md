# FastRoute

FastRoute **[Psr-15](https://www.php-fig.org/psr/psr-15/)** middleware and request handler.

**Require** php >= 7.1

**Installation** `composer require ellipse/router-fastroute`

**Run tests** `./vendor/bin/kahlan`

- [Usage as request handler](https://github.com/ellipsephp/router-fastroute#usage-as-request-handler)
- [Usage as middleware](https://github.com/ellipsephp/router-fastroute#usage-as-middleware)
- [Dispatcher factories helpers](https://github.com/ellipsephp/router-fastroute#dispatcher-factories-helpers)

## Usage as request handler

This package provides an `Ellipse\Router\FastRouteRequestHandler` Psr-15 request handler taking a fastroute dispatcher factory as parameter.

This factory can be any callable returning an implementation of `FastRoute\Dispatcher` and the route handlers it matches are expected to be implementations of `Psr\Http\Server\RequestHandlerInterface`.

When the `FastRouteRequestHandler` handles a request the `Dispatcher` produced by the factory is used to match a Psr-15 request handler. When the matched route pattern contains placeholders, a new request is created with those placeholders => matched value pairs as request attributes. Finally the matched request handler is proxied with this new request to actually return a response.

Using a factory allows to perform the time consuming task of mapping routes only when the request is handled with the `FastRouteRequestHandler`. If for some reason an application handles the incoming request with another request handler, no time is lost mapping routes for this one.

Regarding exceptions:

- An `Ellipse\Router\Exceptions\FastRouteDispatcherTypeException` is thrown when the factory does not return an implementation of `FastRoute\Dispatcher`.
- An `Ellipse\Router\Exceptions\MatchedHandlerTypeException` is thrown when the route handler matched by the fastroute dispatcher is not an implementation of `Psr\Http\Server\RequestHandlerInterface`.
- An `Ellipse\Router\Exceptions\NotFoundException` is thrown when no route match the url.
- An `Ellipse\Router\Exceptions\MethodNotAllowedException` is thrown when a route matches the url but the request http method is not allowed by the matched route.

```php
<?php

namespace App;

use FastRoute\RouteParser;
use FastRoute\DataGenerator;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

use Ellipse\Router\FastRouteRequestHandler;

// Get a psr7 request.
$request = some_psr7_request_factory();

// Create a fastroute dispatcher factory.
$factory = function ($r) {

    // Create a new fastroute route collector.
    $r = new RouteCollector(
        new RouteParser\Std, new DataGenerator\GroupCountBased
    );

    // The route handlers must be Psr-15 request handlers.
    $r->get('/', new SomeRequestHandler);

    // When this route is matched a new request with an 'id' attribute would be passed to the request handler.
    $r->get('/path/{id}', new SomeOtherRequestHandler);

    // return a fastroute dispatcher
    return new Dispatcher\GroupCountBased($r->getData());

};

// Create a fastroute request handler using this factory.
$handler = new FastRouteRequestHandler($factory);

// Produce a response with the fastroute request handler.
$response = $handler->handle($request);
```

## Usage as middleware

This package provides an `Ellipse\Router\FastRouteMiddleware` Psr-15 middleware also taking a fastroute dispatcher factory as parameter.

Under the hood it creates a `FastRouteRequestHandler` with the given factory and use it to handle the request. When a `NotFoundException` is thrown, the request processing is delegated to the next middleware.

```php
<?php

namespace App;

use FastRoute\RouteParser;
use FastRoute\DataGenerator;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

use Ellipse\Router\FastRouteMiddleware;

// Get a psr7 request.
$request = some_psr7_request_factory();

// Create a fastroute dispatcher factory.
$factory = function ($r) {

    // Create a new fastroute route collector.
    $r = new RouteCollector(
        new RouteParser\Std, new DataGenerator\GroupCountBased
    );

    // The route handlers must be Psr-15 request handlers.
    $r->get('/', new SomeRequestHandler);

    // When this route is matched a new request with an 'id' attribute would be passed to the request handler.
    $r->get('/path/{id}', new SomeOtherRequestHandler);

    // return a fastroute dispatcher
    return new Dispatcher\GroupCountBased($r->getData());

};

// Create a fastroute middleware using this factory.
$middleware = new FastRouteMiddleware($factory);

// When a route is matched the request is handled by the matched request handler.
// Otherwise NextRequestHandler is used to handle the request.
$response = $middleware->process($request, new NextRequestHandler);
```
## Dispatcher factories helpers

This package provides two dispatcher factories helpers proxying the [fastroute ones](https://github.com/nikic/FastRoute/blob/master/src/functions.php): `Ellipse\Router\FastRoute\SimpleDispatcher` and `Ellipse\Router\FastRoute\CachedDispatcher`.

Those two classes are just callables proxying their respective fastroute functions to produce a dispatcher when the `FastRouteRequestHandler` handles the request.

```php
<?php

namespace App;

use FastRoute\RouteParser;
use FastRoute\DataGenerator;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

use Ellipse\Router\FastRouteRequestHandler;
use Ellipse\Router\FastRoute\SimpleDispatcher;

// Get a psr7 request.
$request = some_psr7_request_factory();

// Create a route definition callback like with fastroute simpleDispatcher function.
$routeDefinitionCallback = function ($r) {

    // The route handlers must be Psr-15 request handlers.
    $r->get('/', new SomeRequestHandler);

    // When this route is matched a new request with an 'id' attribute would be passed to the request handler.
    $r->get('/path/{id}', new SomeOtherRequestHandler);

};

// An optional array of options can be passed like with fastroute simpleDispatcher function.
$options = [
    // Can specify fastroute classes to use.
];

// Create a fastroute request handlerusing fastroute simpleDispatcher function.
// Same with CachedDispatcher using fastroute cachedDispatcher.
$handler = new FastRouteRequestHandler(new SimpleDispatcher($routeDefinitionCallback, $options));

// Produce a response with the fastroute request handler.
$response = $handler->handle($request);
```
