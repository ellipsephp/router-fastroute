<?php

use function Eloquent\Phony\Kahlan\stub;

use Ellipse\Router\RouterRequestHandler;
use Ellipse\Router\FastRouteRequestHandler;

describe('FastRouteRequestHandler', function () {

    beforeEach(function () {

        $this->factory = stub();

        $this->router = new FastRouteRequestHandler($this->factory);

    });

    it('should extend RouterRequestHandler', function () {

        expect($this->router)->toBeAnInstanceOf(RouterRequestHandler::class);

    });

});
