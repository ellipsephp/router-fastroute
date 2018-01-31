<?php declare(strict_types=1);

namespace Ellipse\Router\FastRoute;

use function FastRoute\cachedDispatcher;

use FastRoute\Dispatcher;

class CachedDispatcher
{
    /**
     * The route mapper.
     *
     * @var callable
     */
    private $mapper;

    /**
     * The fastroute options.
     *
     * @var array
     */
    private $options;

    /**
     * Set up a simple dispatcher with the given mapper and options.
     *
     * @param callable  $mapper
     * @param array     $options
     */
    public function __construct(callable $mapper, array $options = [])
    {
        $this->mapper = $mapper;
        $this->options = $options;
    }

    /**
     * Proxy the fastroute cached dispatcher function.
     *
     * @return \FastRoute\Dispatcher
     */
    public function __invoke(): Dispatcher
    {
        return cachedDispatcher($this->mapper, $this->options);
    }
}
