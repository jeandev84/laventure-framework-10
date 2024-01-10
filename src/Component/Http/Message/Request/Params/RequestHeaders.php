<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Params;

use Laventure\Component\Http\Utils\HeaderParams;
use Laventure\Component\Http\Utils\Parameter;

/**
 * RequestHeaders
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Params
 */
class RequestHeaders extends HeaderParams
{
    /**
     * @param array $params
    */
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
        if (function_exists('getallheaders')) {
            $params = array_merge(getallheaders(), $params);
        }

        return $params;
    }
}
