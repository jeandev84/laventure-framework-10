<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Factory;


use Laventure\Component\Http\Client\Curl\CurlClient;
use Psr\Http\Client\ClientInterface;

/**
 * ClientFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\StreamClient\Factory
*/
class ClientFactory implements ClientFactoryInterface
{


    /**
     * @param array $options
     *
     * @return ClientInterface
    */
    public function createClient(array $options = []): ClientInterface
    {
        return new CurlClient($options);
    }
}