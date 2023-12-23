<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;
use Psr\Http\Message\StreamInterface;

/**
 * StreamResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
 *
 * // TODO Refactoring
 */
class StreamResponse extends Response
{
    /**
     * @throws StreamException
    */
    public function __construct(string $path, int $status = 200, array $headers = [])
    {
        parent::__construct($status, $headers, new Stream($path));
    }
}
