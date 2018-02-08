<?php declare(strict_types=1);

namespace Ellipse\Router\FastRoute;

use Ellipse\Router\RouterMiddleware;

class GroupCountBasedMiddleware extends RouterMiddleware
{
    /**
     * Set up a fastroute middleware using a group count based dispatcher mapped
     * with the given mapper.
     *
     * @param callable $mapper
     */
    public function __construct(callable $mapper)
    {
        parent::__construct(new GroupCountBasedRequestHandler($mapper));
    }
}
