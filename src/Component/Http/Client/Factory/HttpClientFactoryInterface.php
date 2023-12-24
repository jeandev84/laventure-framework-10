<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Factory;

use Psr\Http\Message\ResponseInterface;

/**
 * HttpClientFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Factory
 */
interface HttpClientFactoryInterface
{
    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return ResponseInterface
    */
    public function createRequest(string $method, string $url, array $options = []): ResponseInterface;
}
