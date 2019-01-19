<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable =
        [   'name','commission','link_on_freelancer','chat_link','start_date',
            'end_date','price','price_after_commission','status','notes',
            'project_type_id','client_id','signature'  ];

    public function type(){
        return $this->belongsTo(ProjectType::class,'project_type_id');
    }
    public function client(){
    return $this->belongsTo(Client::class,'client_id');
}

}
