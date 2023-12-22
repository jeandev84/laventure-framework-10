<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Info;


/**
 * UrlInfoInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Parser
 */
interface UrlInfoInterface
{


    /**
     * @return string
    */
    public function getScheme(): string;



    /**
     * @return string
    */
    public function getUsername(): string;




    /**
     * @return string
    */
    public function getPassword(): string;




    /**
     * @return string
    */
    public function getHost(): string;





    /**
     * @return int|null
    */
    public function getPort(): ?int;





    /**
     * @return string
    */
    public function getPath(): string;




    /**
     * @return string
    */
    public function getQuery(): string;





    /**
     * @return string
    */
    public function getFragment(): string;





    /**
     * @return array
    */
    public function toArray(): array;
}