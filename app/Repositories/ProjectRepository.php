<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Project;

class ProjectRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $project = Project::create($data);
        return $project;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $project = Project::find($id);
        if(!$project){
            return false;
        }
        $project = $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $project = Project::destroy($id);
        return $project;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $project = Project::where('id',$id)->with(['type','client'])->get();
        return $project;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $projects = Project::with(['type','client'])->get();
        return $projects;
    }
}