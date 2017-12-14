<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

use FastRoute\Dispatcher;

use Ellipse\Router\FastRouteAdapter;
use Ellipse\Router\MatchedRequestHandler;
use Ellipse\Router\Exceptions\NotFoundException;
use Ellipse\Router\Exceptions\MethodNotAllowedException;

describe('FastRouteAdapter', function () {

    beforeEach(function () {

        $this->dispatcher = mock(Dispatcher::class);

        $this->router = new FastRouteAdapter($this->dispatcher->get());

    });

    describe('->match()', function () {

        beforeEach(function () {

            $this->request = mock(ServerRequestInterface::class);
            $this->uri = mock(UriInterface::class);

            $this->request->getUri->returns($this->uri);
            $this->uri->getPath->returns('/path');

            $this->request->getMethod->returns('GET');

        });

        it('should return a MatchedRequestHandler the given request', function () {

            $handler = new class {};
            $attributes = ['k1' => 'v1', 'k2' => 'v2'];

            $this->dispatcher->dispatch->with('GET', '/path')->returns([
                Dispatcher::FOUND, $handler, $attributes,
            ]);

            $test = $this->router->match($this->request->get());

            $handler = new MatchedRequestHandler($handler, $attributes);

            expect($test)->toEqual($handler);

        });

        it('should fail when no route is matching the given request', function () {

            $this->dispatcher->dispatch->returns([Dispatcher::NOT_FOUND]);

            $test = function () {

                $this->router->match($this->request->get());

            };

            $exception = new NotFoundException('GET', '/path');

            expect($test)->toThrow($exception);

        });

        it('should fail when the given request method is not accepted for its path', function () {

            $this->dispatcher->dispatch->returns([Dispatcher::METHOD_NOT_ALLOWED, ['POST']]);

            $test = function () {

                $this->router->match($this->request->get());

            };

            $exception = new MethodNotAllowedException('/path', ['POST']);

            expect($test)->toThrow($exception);

        });

    });

});
