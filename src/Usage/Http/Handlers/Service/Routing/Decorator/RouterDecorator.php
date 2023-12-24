<?php

declare(strict_types=1);

namespace Laventure\Usage\Http\Handlers\Service\Routing\Decorator;

use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

/**
 * RouterDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Usage\Http\Handlers\Service\Routing\Decorator
 */
class RouterDecorator
{
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }




    /**
     * @param ServerRequestInterface $request
     * @return false|Route
    */
    public function match(ServerRequestInterface $request): Route|false
    {
        return $this->router->match(
            $request->getMethod(),
            $request->getUri()->getPath()
        );
    }
}
