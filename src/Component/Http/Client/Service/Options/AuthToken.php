<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Options;

/**
 * AuthToken
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Options
 */
class AuthToken
{

     /**
      * @param string $accessToken
     */
     public function __construct(private readonly string $accessToken)
     {
     }



    /**
     * @return string
    */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}