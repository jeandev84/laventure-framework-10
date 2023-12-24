<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Handlers\Service\Auth;

use Laventure\Component\Http\Message\Response\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * AuthorizationMap
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Handlers\Service\Auth
 */
class AuthorizationMap
{
    public function needsAuthorization(ServerRequestInterface $request)
    {
        return false;
    }


    public function isAuthorized(ServerRequestInterface $request)
    {
        return false;
    }



    public function prepareUnauthorizedResponse(): ResponseInterface
    {
        return new Response();
    }



    public function signResponse($response, $request): ResponseInterface
    {
        return new Response();
    }
}
