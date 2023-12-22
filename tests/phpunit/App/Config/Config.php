<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Config;

/**
 * Config
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Config
 */
class Config
{
      protected array $params;

      public function __construct(array $params)
      {
           $this->params = $params;
      }
}