<?php

declare(strict_types=1);

namespace Laventure\Usage\Http\Handlers\Middlewares;

use Laventure\Usage\Http\Handlers\Service\Auth\AuthorizationMap;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * AuthorizationMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Usage\Http\Handlers\Middlewares
 */
class AuthorizationMiddleware implements MiddlewareInterface
{
    private $authorizationMap;

    public function __construct(AuthorizationMap $authorizationMap)
    {
        $this->authorizationMap = $authorizationMap;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->authorizationMap->needsAuthorization($request)) {
            return $handler->handle($request);
        }

        if (!$this->authorizationMap->isAuthorized($request)) {
            return $this->authorizationMap->prepareUnauthorizedResponse();
        }

        $response = $handler->handle($request);
        return $this->authorizationMap->signResponse($response, $request);
    }
}
