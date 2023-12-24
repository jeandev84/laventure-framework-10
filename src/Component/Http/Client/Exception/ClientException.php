<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Exception;

use Psr\Http\Client\ClientExceptionInterface;

/**
 * ClientException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Exception
 */
class ClientException extends \Exception implements ClientExceptionInterface
{
}
