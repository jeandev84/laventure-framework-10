<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request\Contract;

use Psr\Http\Client\ClientInterface;

/**
 * ClientServiceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Contract
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






    /**
     * Returns options
     *
     * @return array
    */
    public function getOptions(): array;
}
