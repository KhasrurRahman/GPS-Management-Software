<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllUser extends Model
{
     public function payments()
    {
        return $this->hasMany(payment_history::class,'user_id');
    }
}
