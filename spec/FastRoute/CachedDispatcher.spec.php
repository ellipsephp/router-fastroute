<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use FastRoute\Dispatcher;

use Ellipse\Router\FastRoute\CachedDispatcher;

describe('CachedDispatcher', function () {

    beforeEach(function () {

        $this->mapper = stub();
        $this->options = ['option'];

        $this->factory = new CachedDispatcher($this->mapper, $this->options);

    });

    describe('->__invoke()', function () {

        it('should proxy the fastroute cachedDispatcher function', function () {

            $dispatcher = mock(Dispatcher::class)->get();

            allow('FastRoute\cachedDispatcher')
                ->toBeCalled()
                ->with($this->mapper, $this->options)
                ->andReturn($dispatcher);

            $test = ($this->factory)();

            expect($test)->toBe($dispatcher);

        });

    });

});
