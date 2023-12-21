<?php
declare(strict_types=1);

namespace Laventure\Component\Container\Concrete;

use Laventure\Component\Container\Concrete\Contract\ConcreteInterface;
use Laventure\Component\Container\Resolver\Resolver;
use Psr\Container\ContainerInterface;

/**
 * BindValue
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
     * @var Resolver
    */
    protected Resolver $resolver;



    /**
     * @param string $id
     *
     * @param $value
     *
     * @param Resolver $resolver
    */
    public function __construct(string $id, $value, Resolver $resolver)
    {
        $this->id       = $id;
        $this->value    = $value;
        $this->resolver = $resolver;
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



    public function getDependencies()
    {

    }
}