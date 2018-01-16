<?php

use function Eloquent\Phony\Kahlan\mock;

use FastRoute\Dispatcher;

use Ellipse\Router\RouterMiddleware;
use Ellipse\Router\FastRouteMiddleware;

describe('FastRouteMiddleware', function () {

    beforeEach(function () {

        $this->dispatcher = mock(Dispatcher::class);

        $this->router = new FastRouteMiddleware($this->dispatcher->get());

    });

    it('should extend RouterMiddleware', function () {

        expect($this->router)->toBeAnInstanceOf(RouterMiddleware::class);

    });

});
