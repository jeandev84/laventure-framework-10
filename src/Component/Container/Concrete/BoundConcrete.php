<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Concrete;

use Laventure\Component\Container\Concrete\Contract\ConcreteInterface;

/**
 * BoundConcrete
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Concrete
*/
class BoundConcrete implements ConcreteInterface
{
    /**
     * @var string
     */
    protected string $id;



    /**
     * @var mixed
     */
    protected mixed $value;


    /**
     * @param string $id
     *
     * @param mixed $value
     */
    public function __construct(string $id, mixed $value)
    {
        $this->id       = $id;
        $this->value    = $value;
    }



    /**
     * @inheritdoc
     */
    public function getId(): string
    {
        return $this->id;
    }



    /**
     * @inheritdoc
     */
    public function getValue(): mixed
    {
        return $this->value;
    }




    /**
     * @return bool
     */
    public function callable(): bool
    {
        return is_callable($this->value);
    }
}
