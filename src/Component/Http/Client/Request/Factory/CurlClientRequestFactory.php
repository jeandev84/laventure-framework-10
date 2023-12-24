<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request\Factory;


use Laventure\Component\Http\Client\Request\Contract\ClientRequestInterface;
use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Client\Service\CurlService;

/**
 * CurlClientRequestFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request\Factory
 */
class CurlClientRequestFactory
{
     public static function create(): ClientRequestInterface
     {
          return new CurlRequest(new CurlService());
     }
}