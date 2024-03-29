<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Params;


use Stringable;

/**
 * QueryParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Params
*/
class QueryParams extends InputParams implements Stringable
{
    public function __toString(): string
    {
        return http_build_query($this->params);
    }
}
