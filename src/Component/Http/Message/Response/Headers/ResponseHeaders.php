<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Headers;

use Laventure\Component\Http\Utils\HeaderLine;
use Laventure\Component\Http\Utils\HeaderParams;

/**
 * ResponseHeaders
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Headers
 */
class ResponseHeaders extends HeaderParams
{
    public function __construct(array $params = [])
    {
        parent::__construct($this->resolveParams($params));
    }




    /**
     * @param array $params
     *
     * @return array
    */
    private function resolveParams(array $params): array
    {
        if (function_exists('headers_list')) {
            $params = array_merge(HeaderLine::fromArray(headers_list()), $params);
        }

        return $params;
    }
}
