<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use FastRoute\Dispatcher;

use Ellipse\Router\FastRoute\SimpleDispatcher;

describe('SimpleDispatcher', function () {

    beforeEach(function () {

        $this->mapper = stub();
        $this->options = ['option'];

        $this->factory = new SimpleDispatcher($this->mapper, $this->options);

    });

    describe('->__invoke()', function () {

        it('should proxy the fastroute simpleDispatcher function', function () {

            $dispatcher = mock(Dispatcher::class)->get();

            allow('FastRoute\simpleDispatcher')
                ->toBeCalled()
                ->with($this->mapper, $this->options)
                ->andReturn($dispatcher);

            $test = ($this->factory)();

            expect($test)->toBe($dispatcher);

        });

    });

});
