<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Http;

/**
 * ParameterBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http
 */
class ParameterBag
{
    protected array $params;


    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function get(string $name, $default = null): mixed
    {
        return $this->params[$name] ?? $default;
    }
}