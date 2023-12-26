<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Body;

use Laventure\Component\Http\Client\Service\Body\Contract\ClientParsedBodyInterface;

/**
 * ClientParsedBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Body
 */
abstract class ClientParsedBody implements ClientParsedBodyInterface
{

    /**
     * @var mixed
    */
    protected mixed $body;


    /**
     * @inheritdoc
     */
    public function getBody(): mixed
    {
        return $this->body;
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
          return $this->body;
    }
}