<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment_history extends Model
{
    public function user()
    {
        return $this->belongsTo(AllUser::class,'user_id');
    }
}
