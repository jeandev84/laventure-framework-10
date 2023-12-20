<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route;

/**
 * RouteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
 */
interface RouteInterface extends \ArrayAccess
{
    /**
     * Returns route methods
     *
     * @return array
    */
    public function getMethods(): array;



    /**
     * Returns route path
     *
     * @return string
    */
    public function getPath(): string;





    /**
     * Returns route pattern
     *
     * @return string
    */
    public function getPattern(): string;






    /**
     * Returns route action will be executed.
     *
     * @return mixed
    */
    public function getAction(): mixed;





    /**
     * Returns matches params from url
     *
     * @return array
    */
    public function getParams(): array;





    /**
     * Returns name of route
     *
     * @return string|null
    */
    public function getName(): ?string;





    /**
     * Returns route middlewares
     *
     * @return array
    */
    public function getMiddlewares(): array;





    /**
     * Returns route required params
     *
     * @return array
    */
    public function getPatterns(): array;





    /**
     * Returns route options
     *
     * @return array
    */
    public function getOptions(): array;





    /**
     * Returns controller
     *
     * @return string|null
    */
    public function getController(): ?string;






    /**
     * Determine if the route action is callable
     *
     * @return bool
    */
    public function callable(): bool;








    /**
     * @param string $method
     *
     * @param string $path
     *
     * @return bool
    */
    public function match(string $method, string $path): bool;






    /**
     * Generate route path
     *
     * @param array $parameters
     *
     * @return string
    */
    public function generateUri(array $parameters = []): string;
}
