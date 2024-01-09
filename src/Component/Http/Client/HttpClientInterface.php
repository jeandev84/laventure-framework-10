<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client;

use Psr\Http\Message\ResponseInterface;

/**
 * HttpClientInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\StreamClient
 */
interface HttpClientInterface
{
    /**
     * Send request to client and get a response by each method
     *
     * @param string $method
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return ResponseInterface
    */
    public function request(string $method, string $url, array $options = []): ResponseInterface;
}
