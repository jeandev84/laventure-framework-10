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
      * @param string $id
      *
      * @return string
     */
     public function toUpper(string $id): string
     {
          return strtoupper($this->string($id));
     }





     /**
      * @param string $id
      *
      * @return string
     */
     public function toLower(string $id): string
     {
         return strtolower($this->string($id));
     }







     /**
      * @param $id
      *
      * @return string
     */
     public function string($id): string
     {
          return (string)$this->get($id, '');
     }




     /**
      * @param $id
      * @param $value
      * @return bool
     */
     public function match($id, $value): bool
     {
          return $this->get($id) === $value;
     }




    /**
     * @param $id
     * @param int $default
     * @return int
    */
    public function integer($id, int $default = 0): int
    {
        return (int)$this->get($id, $default);
    }





    /**
     * @param $id
     * @param int $default
     * @return float
    */
    public function float($id, int $default = 0): float
    {
        return (float)$this->get($id, $default);
    }




    /**
     * @param $id
     * @param bool $default
     * @return bool
    */
    public function boolean($id, bool $default = false): bool
    {
        return (bool)$this->get($id, $default);
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
