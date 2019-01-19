<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable =['value','notes','date','signature','account_id'];


    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
