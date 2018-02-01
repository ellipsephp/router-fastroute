<?php declare(strict_types=1);

namespace Ellipse\Router;

use FastRoute\Dispatcher;

use Ellipse\Router\Exceptions\FastRouteDispatcherTypeException;

class FastRouteAdapterFactory implements RouterAdapterFactoryInterface
{
    /**
     * The delegate.
     *
     * @var callable
     */
    private $delegate;

    /**
     * Set up a fastroute adapter factory with the given delegate.
     *
     * @param callable $delegate
     */
    public function __construct(callable $delegate)
    {
        $this->delegate = $delegate;
    }

    /**
     * Return a new fastroute adapter wrapped around the dispatcher produced by
     * the delegate.
     *
     * @return \Ellipse\Router\RouterAdapterInterface
     * @throws \Ellipse\Router\Exceptions\FastRouteDispatcherTypeException
     */
    public function __invoke(): RouterAdapterInterface
    {
        $dispatcher = ($this->delegate)();

        if ($dispatcher instanceof Dispatcher) {

            return new FastRouteAdapter($dispatcher);

        }

        throw new FastRouteDispatcherTypeException($dispatcher);
    }
}
