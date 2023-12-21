<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Exception;

/**
 * NotFoundRouteException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Exception
 */
class NotFoundRouteException extends \Exception
{
    public function __construct(string $path)
    {
        parent::__construct("Route $path can not found.", 404);
    }
}
