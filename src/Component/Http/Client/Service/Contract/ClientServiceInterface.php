<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Contract;


use Laventure\Component\Http\Client\Response\Contract\ClientResponseInterface;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOptionInterface;

/**
 * ClientServiceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Contract
 */
interface ClientServiceInterface
{


    /**
     * Set request URI
     *
     * @param string $path
     *
     * @return mixed
    */
    public function uri(string $path): static;





    /**
     * Set request method
     *
     * @param string $method
     *
     * @return $this
    */
    public function method(string $method): static;







    /**
     * Parse request options
     *
     * @return $this
    */
    public function options(ClientServiceOptionInterface $options): static;







    /**
     * @return ClientResponseInterface
    */
    public function send(): ClientResponseInterface;






    /**
     * @return array
    */
    public function toArray(): array;
}