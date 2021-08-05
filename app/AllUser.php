<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllUser extends Model
{
     public function payments()
    {
        return $this->hasMany(payment_history::class,'user_id');
    }
    
    public function assign_techician()
    {
        return $this->hasOne(Assign_technician_device::class,'user_id','id')->where('status',0);
    }
    
    public function bill_schedule()
    {
        return $this->hasOne(Billing_shedule::class,'user_id','id');
    }
}
