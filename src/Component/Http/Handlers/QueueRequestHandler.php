<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Handlers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * QueueRequestHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Handlers
*/
class QueueRequestHandler implements RequestHandlerInterface
{
    /**
     * Middleware stack
     *
     * @var MiddlewareInterface[]
    */
    private array $middleware = [];




    /**
     * Fallback handler
     *
     * @var RequestHandlerInterface
    */
    private RequestHandlerInterface $fallbackHandler;





    /**
     * @param RequestHandlerInterface $fallbackHandler
    */
    public function __construct(RequestHandlerInterface $fallbackHandler)
    {
        $this->fallbackHandler = $fallbackHandler;
    }




    /**
     * @param MiddlewareInterface $middleware
     *
     * @return $this
    */
    public function add(MiddlewareInterface $middleware): static
    {
        $this->middleware[] = $middleware;

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Last middleware in the queue has called on the request handler.
        if (0 === count($this->middleware)) {
            return $this->fallbackHandler->handle($request);
        }

        $middleware = array_shift($this->middleware);
        return $middleware->process($request, $this);
    }
}

/*
// Fallback handler:
$fallbackHandler = new NotFoundHandler();

// Create request handler instance:
$app = new QueueRequestHandler($fallbackHandler);

// Add one or more middleware:
$app->add(new AuthorizationMiddleware());
$app->add(new RoutingMiddleware());

// execute it:
$response = $app->handle(ServerRequestFactory::fromGlobals());
*/
