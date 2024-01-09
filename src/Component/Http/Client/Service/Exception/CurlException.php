<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Exception;


use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;

/**
 * CurlException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Exception
*/
class CurlException extends \Exception implements ClientServiceExceptionInterface
{

}