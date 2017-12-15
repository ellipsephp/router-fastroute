<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;

use FastRoute\Dispatcher;

use Ellipse\Router\Exceptions\NotFoundException;
use Ellipse\Router\Exceptions\MethodNotAllowedException;

class FastRouteAdapter implements RouterAdapterInterface
{
    /**
     * The fastroute dispatcher.
     *
     * @var \FastRoute\Dispatcher
     */
    private $dispatcher;

    /**
     * Set up a fast route adapter with the given dispatcher.
     *
     * @param \FastRoute\Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @inheritdoc
     */
    public function match(ServerRequestInterface $request): MatchedRequestHandler
    {
        $uri = $request->getUri()->getPath();
        $method = $request->getMethod();

        $info = $this->dispatcher->dispatch($method, $uri);

        if ($info[0] == Dispatcher::METHOD_NOT_ALLOWED) {

            $allowed_methods = $info[1];

            throw new MethodNotAllowedException($uri, $allowed_methods);

        }

        if ($info[0] == Dispatcher::NOT_FOUND) {

            throw new NotFoundException($method, $uri);

        }

        $handler = $info[1];
        $attributes = $info[2];

        return new MatchedRequestHandler($handler, $attributes);
    }
}
