<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    protected $fillable = ['name','shortcut','logo'];

    public function accounts(){
        return $this->hasMany(Account::class,'currency_id');
    }

}
