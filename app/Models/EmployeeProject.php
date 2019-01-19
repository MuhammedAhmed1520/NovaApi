<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProject extends Model
{
    //
    protected $table='employee_projects';

    protected $fillable=['commission','value','notes','status','finished_id','employee_id','signature'];

    public function finishedProject(){
        return $this->belongsTo(FinishedProject::class,'finished_id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

}