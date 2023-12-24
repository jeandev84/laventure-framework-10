<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Handlers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * DecoratingRequestHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Handlers
 */
class DecoratingRequestHandler implements RequestHandlerInterface
{
    /**
     * @var MiddlewareInterface
    */
    private MiddlewareInterface $middleware;



    /**
     * @var RequestHandlerInterface
    */
    private RequestHandlerInterface $nextHandler;



    /**
     * @param MiddlewareInterface $middleware
     *
     * @param RequestHandlerInterface $nextHandler
    */
    public function __construct(MiddlewareInterface $middleware, RequestHandlerInterface $nextHandler)
    {
        $this->middleware = $middleware;
        $this->nextHandler = $nextHandler;
    }





    /**
     * @inheritdoc
    */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->middleware->process($request, $this->nextHandler);
    }
}


/*
// Create a response prototype to return if no middleware can produce a response
// on its own. This could be a 404, 500, or default page.
$responsePrototype = (new Response())->withStatus(404);
$innerHandler = new class ($responsePrototype) implements RequestHandlerInterface {
    private $responsePrototype;

    public function __construct(ResponseInterface $responsePrototype)
    {
        $this->responsePrototype = $responsePrototype;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->responsePrototype;
    }
};

$layer1 = new DecoratingRequestHandler(new RoutingMiddleware(), $innerHandler);
$layer2 = new DecoratingRequestHandler(new AuthorizationMiddleware(), $layer1);

$response = $layer2->handle(ServerRequestFactory::fromGlobals());
*/
