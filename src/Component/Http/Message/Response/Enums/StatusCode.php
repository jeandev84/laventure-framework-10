<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Enums;


/**
 * ResponseStatusCode
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Enums
 */
enum StatusCode: int
{
     case OK = 200;
     case BAD_REQUEST = 400;
     case INTERNAL_SERVER_ERROR = 500;
}