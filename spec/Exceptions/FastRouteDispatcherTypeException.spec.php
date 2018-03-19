<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\FastRouteDispatcherTypeException;

describe('FastRouteDispatcherTypeException', function () {

    beforeEach(function () {

        $this->exception = new FastRouteDispatcherTypeException('dispatcher');

    });

    it('should extend TypeError', function () {

        expect($this->exception)->toBeAnInstanceOf(TypeError::class);

    });

    it('should implement RouterAdapterExceptionInterface', function () {

        expect($this->exception)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
