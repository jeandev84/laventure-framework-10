<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Body;

use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;

/**
 * RequestBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Body
*/
class RequestBody extends Stream
{
    /**
     * @param string $resource
     * @param string $accessMode
     * @throws StreamException
    */
    public function __construct(string $resource = '', string $accessMode = 'r+')
    {
        parent::__construct($resource ?: 'php://input', $accessMode);
    }
}
