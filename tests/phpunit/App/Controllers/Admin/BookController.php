<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Controllers\Admin;

/**
 * BookController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Controllers\Admin
 */
class BookController
{

    public function index(): string
    {
        return "BookController::index";
    }


    public function show(int $id): string
    {
        return "BookController::show";
    }


    public function store(array $params): string
    {
        return "BookController::store";
    }



    public function update($id): string
    {
        return "BookController::update";
    }




    public function delete($id): string
    {
        return "BookController::delete";
    }
}