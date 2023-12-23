<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;


use Psr\Http\Message\StreamInterface;

/**
 * RedirectResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
 */
class RedirectResponse extends Response
{


       /**
        * @param string $path
        *
        * @param int $status
       */
       public function __construct(string $path, int $status = 302)
       {
           parent::__construct($status, ['Location' => $path]);
       }
}