<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneyTransfers extends Model
{
    //
    protected $fillable =

        ['actual_value','value','expected_date','status','signature','notes','account_from_id','account_to_id',];

    public function from(){
        return $this->belongsTo(Account::class,'account_from_id');
    }
    public function to(){
        return $this->belongsTo(Account::class,'account_to_id');
    }
}
