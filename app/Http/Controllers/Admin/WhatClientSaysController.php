<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhatClientSaysController extends Controller
{
    public function client_says()
    {
        return view('backend.what_client_sas');
    }
}
