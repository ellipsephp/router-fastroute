<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

use FastRoute\Dispatcher;

class FastRouteRequestHandler implements RequestHandlerInterface
{
    /**
     * The fastroute adapter.
     *
     * @var \Ellipse\Router\RouterRequestHandler
     */
    private $delegate;

    /**
     * Set up a fast route request handler with the given dispatcher.
     *
     * @param \FastRoute\Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->delegate = new RouterRequestHandler(
            new FastRouteAdapter($dispatcher)
        );
    }

    /**
     * @inheritdoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->delegate->handle($request);
    }
}
