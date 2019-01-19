<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\EmployeeProject;

class EmployeeFinishedProjectRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $project = EmployeeProject::create($data);
        return $project;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $project = EmployeeProject::find($id);
        if(!$project){
            return false;
        }
        $project = $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $project = EmployeeProject::destroy($id);
        return $project;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $project = EmployeeProject::where('id',$id)->with(['finishedProject.project','employee'])->get();
        return $project;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $projects = EmployeeProject::with(['finishedProject.project','employee'])->get();
        return $projects;
    }
}