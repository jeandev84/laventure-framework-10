<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Body\Contract;


use Stringable;

/**
 * ClientParsedBodyInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Body\Contract
 */
interface ClientParsedBodyInterface extends Stringable
{

       /**
        * Returns the body may be string|array|resource|\Traversable|\Closure
        * (the callback SHOULD yield a string)
        *
        * @return mixed
       */
       public function getBody(): mixed;




       /**
        * Here you need to resolve your body as string
        *
        * @inheritDoc
       */
       public function __toString(): string;
}