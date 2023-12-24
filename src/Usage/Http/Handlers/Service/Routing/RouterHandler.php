<?php

declare(strict_types=1);

namespace Laventure\Usage\Http\Handlers\Service\Routing;

use Laventure\Component\Http\Message\Response\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * RouterHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Usage\Http\Handlers\Service\Auth
 */
class RouterHandler implements RequestHandlerInterface
{
    /**
     * @param Router $router
    */
    public function __construct(protected Router $router)
    {
    }


    /**
     * @inheritDoc
    */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response();
    }
}
