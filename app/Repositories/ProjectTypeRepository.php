<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\ProjectType;

class ProjectTypeRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $project_type = ProjectType::create($data);
        return $project_type;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $project_type = ProjectType::find($id);
        if(!$project_type){
            return false;
        }
        $project_type = $project_type->update($data);
        return $project_type;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $project_type = ProjectType::destroy($id);
        return $project_type;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $project_type = ProjectType::find($id);
        return $project_type;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $project_types = ProjectType::all();
        return $project_types;
    }
}