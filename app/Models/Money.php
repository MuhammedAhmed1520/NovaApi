<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    //

    protected $fillable = ['value', 'notes', 'signature', 'project_id', 'account_id'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

}
