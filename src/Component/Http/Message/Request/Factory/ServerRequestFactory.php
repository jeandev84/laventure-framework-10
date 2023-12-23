<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Factory;

use Laventure\Component\Http\Message\Request\ServerRequest;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * ServerRequestFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Factory
 */
class ServerRequestFactory implements ServerRequestFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        return new ServerRequest($method, $uri, $serverParams);
    }




    /**
     * @return ServerRequestInterface
    */
    public static function createFromGlobals(): ServerRequestInterface
    {
        return ServerRequest::fromGlobals();
    }
}
