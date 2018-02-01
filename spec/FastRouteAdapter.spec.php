<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

use FastRoute\Dispatcher;

use Ellipse\Router\FastRouteAdapter;
use Ellipse\Router\MatchedRequestHandler;
use Ellipse\Router\RouterAdapterInterface;
use Ellipse\Router\Exceptions\NotFoundException;
use Ellipse\Router\Exceptions\MethodNotAllowedException;

describe('FastRouteAdapter', function () {

    beforeEach(function () {

        $this->dispatcher = mock(Dispatcher::class);

        $this->adapter = new FastRouteAdapter($this->dispatcher->get());

    });

    it('should implement RouterAdapterInterface', function () {

        expect($this->adapter)->toBeAnInstanceOf(RouterAdapterInterface::class);

    });

    describe('->match()', function () {

        beforeEach(function () {

            $this->request = mock(ServerRequestInterface::class);
            $this->uri = mock(UriInterface::class);

            $this->request->getUri->returns($this->uri);
            $this->uri->getPath->returns('/path');

            $this->request->getMethod->returns('GET');

        });

        context('when a route is matched', function () {

            it('should return a MatchedRequestHandler wrapping the matched handler and attributes', function () {

                $handler = new class {};
                $attributes = ['k1' => 'v1', 'k2' => 'v2'];

                $this->dispatcher->dispatch->with('GET', '/path')->returns([
                    Dispatcher::FOUND, $handler, $attributes,
                ]);

                $test = $this->adapter->match($this->request->get());

                $handler = new MatchedRequestHandler($handler, $attributes);

                expect($test)->toEqual($handler);

            });

        });

        context('when no route is matching the request path', function () {

            it('should throw a NotFoundException', function () {

                $this->dispatcher->dispatch->returns([Dispatcher::NOT_FOUND]);

                $test = function () {

                    $this->adapter->match($this->request->get());

                };

                $exception = new NotFoundException('/path');

                expect($test)->toThrow($exception);

            });

        });

        context('when a route is matching the request path but with a different method', function () {

            it('should throw a MethodNotAllowedException', function () {

                $this->dispatcher->dispatch->returns([Dispatcher::METHOD_NOT_ALLOWED, ['POST']]);

                $test = function () {

                    $this->adapter->match($this->request->get());

                };

                $exception = new MethodNotAllowedException('GET', '/path', ['POST']);

                expect($test)->toThrow($exception);

            });

        });

    });

});
