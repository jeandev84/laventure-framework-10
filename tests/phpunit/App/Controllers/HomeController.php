<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Controllers;

use Laventure\Component\Container\Common\ContainerAwareInterface;
use Laventure\Component\Container\Common\ContainerAwareTrait;
use Psr\Container\ContainerInterface;

/**
 * HomeController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Controllers
 */
class HomeController implements ContainerAwareInterface
{

     use ContainerAwareTrait;

     /*
     public function __construct(protected ContainerInterface $container)
     {
     }
     */


     public function index(int $id, string $slug)
     {
         #echo $this->container->get('name'), "\n";
         #echo $this->container->get('path'), "\n";
         return $this->container->get('name') . "-($slug-$id|$id-$slug)";
     }
}