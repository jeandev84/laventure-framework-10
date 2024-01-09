<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Stream;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * StreamClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\StreamClient\Stream
 */
class StreamClient implements ClientInterface
{

    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        // TODO: Implement sendRequest() method.
    }
}