<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Utils\Contract;

/**
 * ParameterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Utils\Contract
*/
interface ParameterInterface
{
    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function set($id, $value): static;




    /**
     * @param array $params
     *
     * @return mixed
    */
    public function add(array $params): static;





    /**
     * @param $id
     * @return bool
    */
    public function has($id): bool;





    /**
     * @param $id
     * @param null $default
     * @return mixed
    */
    public function get($id, $default = null): mixed;





    /**
     * @param $id
     *
     * @return void
    */
    public function remove($id): void;





    /**
     * @return array
    */
    public function all(): array;
}
