<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign_technician_device extends Model
{
    public function technician()
    {
        return $this->belongsTo(Technician::class,'technician_id','id');
    }
}
