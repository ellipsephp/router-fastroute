<?php

use function Eloquent\Phony\Kahlan\stub;

use Ellipse\Router\FastRouteRequestHandler;
use Ellipse\Router\FastRoute\GroupCountBasedRequestHandler;

describe('GroupCountBasedRequestHandler', function () {

    beforeEach(function () {

        $this->middleware = new GroupCountBasedRequestHandler(stub());

    });

    it('should extend FastRouteRequestHandler', function () {

        expect($this->middleware)->toBeAnInstanceOf(FastRouteRequestHandler::class);

    });

});
