<?php

use function Eloquent\Phony\Kahlan\mock;

use FastRoute\Dispatcher;

use Ellipse\Router\RouterRequestHandler;
use Ellipse\Router\FastRouteRequestHandler;

describe('FastRouteRequestHandler', function () {

    beforeEach(function () {

        $this->dispatcher = mock(Dispatcher::class);

        $this->router = new FastRouteRequestHandler($this->dispatcher->get());

    });

    it('should extend RouterRequestHandler', function () {

        expect($this->router)->toBeAnInstanceOf(RouterRequestHandler::class);

    });

});
