<?php

use function Eloquent\Phony\Kahlan\stub;

use Ellipse\Router\RouterMiddleware;
use Ellipse\Router\FastRouteMiddleware;

describe('FastRouteMiddleware', function () {

    beforeEach(function () {

        $this->factory = stub();

        $this->router = new FastRouteMiddleware($this->factory);

    });

    it('should extend RouterMiddleware', function () {

        expect($this->router)->toBeAnInstanceOf(RouterMiddleware::class);

    });

});
