<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Utils;


/**
 * HeaderLine
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Utils
*/
class HeaderLine
{
       public static function transformFromArray(array $headers): array
       {
           $resolved = [];
           foreach ($headers as $header) {
               [$name, $value]  = explode(':', $header);
               $resolved[$name] = (array)trim($value);
           }
           return $resolved;
       }
}