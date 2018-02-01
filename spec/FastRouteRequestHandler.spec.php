<?php

use function Eloquent\Phony\Kahlan\stub;

use Ellipse\Router\RouterRequestHandler;
use Ellipse\Router\FastRouteRequestHandler;

describe('FastRouteRequestHandler', function () {

    beforeEach(function () {

        $this->router = new FastRouteRequestHandler(stub());

    });

    it('should extend RouterRequestHandler', function () {

        expect($this->router)->toBeAnInstanceOf(RouterRequestHandler::class);

    });

});
