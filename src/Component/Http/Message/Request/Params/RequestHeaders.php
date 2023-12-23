<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Params;

use Laventure\Component\Http\Parameter\Parameter;

/**
 * RequestHeaders
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Params
 */
class RequestHeaders extends Parameter
{
    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        if (function_exists('getallheaders')) {
            $params = getallheaders();
        }

        parent::__construct($params);
    }
}
