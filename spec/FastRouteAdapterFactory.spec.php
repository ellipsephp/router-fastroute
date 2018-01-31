<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use FastRoute\Dispatcher;

use Ellipse\Router\RouterAdapterFactoryInterface;
use Ellipse\Router\FastRouteAdapterFactory;
use Ellipse\Router\FastRouteAdapter;
use Ellipse\Router\Exceptions\FastRouteDispatcherTypeException;

describe('FastRouteAdapterFactory', function () {

    beforeEach(function () {

        $this->delegate = stub();

        $this->factory = new FastRouteAdapterFactory($this->delegate);

    });

    it('should implement RouterAdapterFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(RouterAdapterFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        context('when the delegate returns an implementation of Dispatcher', function () {

            it('should return a FastRouteAdapter wrapped around the dispatched produced by the delegate', function () {

                $dispatcher = mock(Dispatcher::class)->get();

                $this->delegate->returns($dispatcher);

                $test = ($this->factory)();

                $adapter = new FastRouteAdapter($dispatcher);

                expect($test)->toEqual($adapter);

            });

        });

        context('when the delegate does not return an implementation of Dispatcher', function () {

            it('should throw a FastRouteDispatcherTypeException', function () {

                $this->delegate->returns('dispatcher');

                $test = function () { ($this->factory)(); };

                $exception = new FastRouteDispatcherTypeException('dispatcher');

                expect($test)->toThrow($exception);

            });

        });

    });

});
