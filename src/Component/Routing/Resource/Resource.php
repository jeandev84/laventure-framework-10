<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Resource;

/**
 * Resource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Resource
 */
abstract class Resource implements ResourceInterface
{
    /**
     * @var string
    */
    protected string $name;



    /**
     * @var string
    */
    protected string $controller;




    /**
     * @param string $name
     *
     * @param string $controller
    */
    public function __construct(string $name, string $controller)
    {
        $this->name       = strtolower($name);
        $this->controller = $controller;
    }




    /**
     * @param string $suffix
     *
     * @return string
     */
    protected function path(string $suffix = ''): string
    {
        return sprintf('%s%s', $this->name, $suffix);
    }






    /**
     * @param string $action
     *
     * @return array
    */
    protected function action(string $action): array
    {
        return [$this->controller, $action];
    }







    /**
     * @param string $name
     *
     * @return string
    */
    protected function name(string $name): string
    {
        return sprintf('%s.%s', $this->name, $name);
    }





    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return $this->name;
    }







    /**
     * @inheritdoc
    */
    public function getController(): string
    {
        return $this->controller;
    }

}
