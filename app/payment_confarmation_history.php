<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment_confarmation_history extends Model
{
    public function user()
    {
        return $this->belongsTo(AllUser::class,'user_id');
    }
    
    public function bill_collected()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
}
