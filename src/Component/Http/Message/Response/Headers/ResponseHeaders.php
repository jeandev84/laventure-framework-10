<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Headers;

use Laventure\Component\Http\Utils\HeaderLine;
use Laventure\Component\Http\Utils\HeaderParameter;
use Laventure\Component\Http\Utils\Parameter;

/**
 * ResponseHeaders
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Headers
 */
class ResponseHeaders extends Parameter
{
    public function __construct(array $params = [])
    {
        if (function_exists('headers_list')) {
             $params = HeaderLine::transformFromArray(headers_list());
        }

        parent::__construct($params);
    }
}
