<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $employee = Employee::create($data);
        return $employee;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $employee = Employee::find($id)->update($data);
        return $employee;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $employee = Employee::destroy($id);
        return $employee;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $employee = Employee::find($id);
        return $employee;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $employees = Employee::all();
        return $employees;
    }
}