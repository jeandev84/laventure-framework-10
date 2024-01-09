<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request\Contract;

use Psr\Http\Client\ClientInterface;

/**
 * ClientRequestInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request\Contract
 */
interface ClientRequestInterface extends ClientInterface
{
    /**
     * Client options
     *
     * @param array $options
     *
     * @return static
    */
    public function withOptions(array $options): static;
}
