<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedProject extends Model
{
    //
    protected $fillable=['review','rate','signature','project_id'];

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

}
