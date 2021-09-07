<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public function user()
    {
        return $this->belongsTo(AllUser::class,'user_id');
    }
    
    public function package()
    {
        return $this->belongsTo(Price_categaroy::class,'package_id');
    }
}
