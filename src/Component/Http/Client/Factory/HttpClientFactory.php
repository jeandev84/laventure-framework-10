<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Factory;


use Laventure\Component\Http\Client\HttpClient;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * HttpClientFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Factory
 */
class HttpClientFactory implements HttpClientFactoryInterface
{

    /**
     * @inheritDoc
     * @throws ClientExceptionInterface
    */
    public function createRequest(string $method, string $url, array $options = []): ResponseInterface
    {
         return HttpClient::create()->request($method, $url, $options);
    }
}