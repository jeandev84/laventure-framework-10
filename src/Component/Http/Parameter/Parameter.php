<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Parameter;


use Laventure\Component\Http\Parameter\Contract\ParameterInterface;

/**
 * Parameter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Parameter
*/
class Parameter implements ParameterInterface
{


    /**
     * @var array
    */
    protected array $params = [];




    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        $this->add($params);
    }




    /**
     * @inheritDoc
    */
    public function set($id, $value): static
    {
        $this->params[$id] = $value;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function add(array $params): static
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function has($id): bool
    {
        return isset($this->params[$id]);
    }




    /**
     * @inheritDoc
    */
    public function get($id, $default = null): mixed
    {
         return $this->params[$id] ?? $default;
    }





    /**
     * @inheritDoc
    */
    public function remove($id): void
    {
        unset($this->params[$id]);
    }




    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return $this->params;
    }
}