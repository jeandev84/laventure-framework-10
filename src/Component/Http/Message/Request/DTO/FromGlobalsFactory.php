<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\DTO;

/**
 * FromGlobalFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\DTO
*/
class FromGlobalsFactory
{

     /**
      * @return FromGlobals
     */
     public static function createDto(): FromGlobals
     {
        return new FromGlobals(
            $_GET,
            $_POST,
            $_SERVER,
            $_FILES,
            $_COOKIE
        );
     }
}