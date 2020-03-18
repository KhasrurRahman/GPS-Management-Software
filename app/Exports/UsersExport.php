<?php

namespace App\Exports;

use App\AllUser;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AllUser::select('name','phone','email')->get();
    }
}
