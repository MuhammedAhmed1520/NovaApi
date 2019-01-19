<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\FinishedProject;

class FinishedProjectRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $project = FinishedProject::create($data);
        return $project;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $project = FinishedProject::find($id);
        if(!$project){
            return false;
        }
        $project = $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $project = FinishedProject::destroy($id);
        return $project;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $project = FinishedProject::where('id',$id)->with(['project'])->get();
        return $project;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $projects = FinishedProject::with(['project'])->get();
        return $projects;
    }
}