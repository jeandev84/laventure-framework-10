<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Curl;

use Laventure\Component\Http\Client\Client;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * CurlClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\StreamClient\Curl
*/
class CurlClient extends Client
{

    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {

    }
}