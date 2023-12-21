<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Concrete\Contract;

/**
 * ConcreteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Concrete\Contract
 */
interface ConcreteInterface
{
    /**
     * @return string
    */
    public function getId(): string;



    /**
     * @return mixed
    */
    public function getValue(): mixed;
}
