<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Controllers\Admin;

/**
 * UserController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Controllers\Admin
 */
class UserController
{
     public function index(): string
     {
         return "UserController::index";
     }


    public function show(int $id): string
    {
        return "UserController::show";
    }


    public function store(array $params): string
    {
        return "UserController::store";
    }



    public function update($id): string
    {
        return "UserController::update";
    }




    public function delete($id): string
    {
        return "UserController::delete";
    }
}