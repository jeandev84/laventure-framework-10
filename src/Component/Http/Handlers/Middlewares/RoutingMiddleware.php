<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Handlers\Middlewares;

use Laventure\Component\Http\Handlers\Service\Routing\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * RoutingMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Handlers\Middlewares
 */
class RoutingMiddleware implements MiddlewareInterface
{
    /**
     * @var Router
    */
    private Router $router;



    /**
     * @param Router $router
    */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }


    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $result = $this->router->match($request);

        if ($result->isSuccess()) {
            return $result->getHandler()->handle($request);
        }

        return $handler->handle($request);
    }
}
