<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Contract;


/**
 * ClientRequestInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request\Contract
 */
interface ClientServiceInterface
{


    /**
     * @param string $path
     *
     * @return $this
    */
    public function uri(string $path): static;





    /**
     * @param string $method
     *
     * @return $this
    */
    public function method(string $method): static;





    /**
     * @return string
    */
    public function getBody(): string;





    /**
     * @return array
    */
    public function getHeaders(): array;





    /**
     * @return int
    */
    public function getStatusCode(): int;





    /**
     * @param $key
     *
     * @return mixed
    */
    public function getInfo($key): mixed;





    /**
     * @return array
    */
    public function getInfos(): array;






    /**
     * @return mixed
    */
    public function send(): mixed;
}