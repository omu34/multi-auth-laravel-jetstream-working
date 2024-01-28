<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{

    public function index()
    {
        return view('client.applications.index');
    }

}
