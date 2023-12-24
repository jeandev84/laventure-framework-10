<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request\Contract;


/**
 * ClientRequestInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request\Contract
 */
interface ClientRequestInterface
{


    /**
     * @return string
    */
    public function getUri(): string;




    /**
     * @return string
    */
    public function getMethod(): string;





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
     * @return array
    */
    public function getInfo(): array;







    /**
     * @return mixed
    */
    public function send(): mixed;
}