<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Options;


use Laventure\Component\Http\Client\Service\Cookies\ClientCookieInterface;
use Laventure\Component\Http\Client\Service\Files\ClientFileInterface;
use Laventure\Component\Http\Utils\Contract\ParameterInterface;

/**
 * ClientServiceOptionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Options
 */
interface ClientServiceOptionInterface extends ParameterInterface
{
    /**
     * Returns request query
     *
     * @return array
    */
    public function query(): array;





    /**
     * Returns request body
     *
     * @return array|string
    */
    public function body(): array|string;







    /**
     * @return array|string
    */
    public function json(): array|string;








    /**
     * Returns request headers
     *
     * @return array
    */
    public function headers(): array;






    /**
     * Returns access token
     *
     * @return string
    */
    public function accessToken(): string;







    /**
     * @return AuthBasicOptions
    */
    public function authBasic(): AuthBasicOptions;






    /**
     * @return string
    */
    public function proxy(): string;






    /**
     * @return ClientFileInterface[]
    */
    public function files(): array;






    /**
     * @return ClientCookieInterface[]
    */
    public function cookies(): array;
}