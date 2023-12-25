<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Options;

/**
 * AuthBasicOptions
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Options
 */
class AuthBasicOptions
{
    public function __construct(
        public string $login,
        public string $password
    )
    {
    }




    /**
     * @return string
    */
    public function toString(): string
    {
        if (! $this->login) {
            return '';
        }

        return "$this->login:$this->password";
    }
}