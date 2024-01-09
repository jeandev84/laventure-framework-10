<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Options;


use Laventure\Component\Http\Utils\Parameter;

/**
 * ClientServiceParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Params
 */
class ClientServiceOption extends Parameter implements ClientServiceOptionInterface
{
    /**
     * @var array
    */
    protected array $params = [
        'query'              => [],           // type string[]
        'body'               => '',           // type array|string
        'json'               => null,         // type array|string
        'headers'            => [],           // type string[]
        'proxy'              => '',           // type string[]
        'auth_basic'         => null,         // type AuthBasic('YOUR_LOGIN', 'YOUR_PASSWORD')
        'auth_token'         => '',           // type AuthToken('YOUR_ACCESS_TOKEN')
        'upload'             => null,         // type string
        'download'           => null,         // type string
        'files'              => [],           // type ClientFileInterface[]
        'cookies'            => [],           // type ClientCookieInterface[]
    ];
}