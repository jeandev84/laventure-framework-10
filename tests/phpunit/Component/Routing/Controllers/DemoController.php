<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing\Controllers;

/**
 * DemoController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Routing\Controllers
 */
class DemoController
{
      public function index(): string
      {
           return __METHOD__;
      }
}