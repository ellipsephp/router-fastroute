<?php declare(strict_types=1);

namespace Ellipse\Router\FastRoute;

use function FastRoute\simpleDispatcher;

use FastRoute\Dispatcher;

class SimpleDispatcher
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
     * Proxy the fastroute simple dispatcher function.
     *
     * @return \FastRoute\Dispatcher
     */
    public function __invoke(): Dispatcher
    {
        return simpleDispatcher($this->mapper, $this->options);
    }
}
