<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $fillable=['name','default_value','signature','value','notes','account_type_id','currency_id'];


    public function type(){
        return $this->belongsTo(AccountType::class,'account_type_id');
    }

    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }

    public function withdrawal(){
        return $this->hasMany(MoneyTransfers::class,'account_from_id');
    }
    public function deposit(){
        return $this->hasMany(MoneyTransfers::class,'account_to_id');
    }
}
