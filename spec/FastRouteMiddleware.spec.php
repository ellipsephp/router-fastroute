<?php

use function Eloquent\Phony\Kahlan\stub;

use Ellipse\Router\RouterMiddleware;
use Ellipse\Router\FastRouteMiddleware;

describe('FastRouteMiddleware', function () {

    beforeEach(function () {

        $this->middleware = new FastRouteMiddleware(stub());

    });

    it('should extend RouterMiddleware', function () {

        expect($this->middleware)->toBeAnInstanceOf(RouterMiddleware::class);

    });

});
