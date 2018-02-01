<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\FastRouteDispatcherTypeException;

describe('FastRouteDispatcherTypeException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test = new FastRouteDispatcherTypeException('dispatcher');

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
