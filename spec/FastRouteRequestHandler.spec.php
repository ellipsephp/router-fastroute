<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

use FastRoute\Dispatcher;

use Ellipse\Router\RouterRequestHandler;
use Ellipse\Router\FastRouteRequestHandler;

describe('FastRouteRequestHandler', function () {

    beforeEach(function () {

        $this->delegate = mock(RouterRequestHandler::class);

        allow(RouterRequestHandler::class)->toBe($this->delegate->get());

        $this->dispatcher = mock(Dispatcher::class);

        $this->router = new FastRouteRequestHandler($this->dispatcher->get());

    });

    it('should implement RequestHandlerInterface', function () {

        expect($this->router)->toBeAnInstanceOf(RequestHandlerInterface::class);

    });

    describe('->handle()', function () {

        it('should proxy the delegate ->handle() method', function () {

            $request = mock(ServerRequestInterface::class)->get();
            $response = mock(ResponseInterface::class)->get();

            $this->delegate->handle->with($request)->returns($response);

            $test = $this->router->handle($request);

            expect($test)->toBe($response);

        });

    });

});
