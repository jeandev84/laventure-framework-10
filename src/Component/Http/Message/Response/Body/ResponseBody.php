<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Body;

use Laventure\Component\Http\Message\Stream\Stream;

/**
 * ResponseBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Body
 */
class ResponseBody extends Stream
{
    public function __construct(string $resource = '', string $accessMode = 'w')
    {
        parent::__construct($resource ?: 'php://output', $accessMode);
    }
}
