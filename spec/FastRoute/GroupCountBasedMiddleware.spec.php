<?php

use function Eloquent\Phony\Kahlan\stub;

use Ellipse\Router\RouterMiddleware;
use Ellipse\Router\FastRoute\GroupCountBasedMiddleware;

describe('GroupCountBasedMiddleware', function () {

    beforeEach(function () {

        $this->middleware = new GroupCountBasedMiddleware(stub());

    });

    it('should extend RouterMiddleware', function () {

        expect($this->middleware)->toBeAnInstanceOf(RouterMiddleware::class);

    });

});
