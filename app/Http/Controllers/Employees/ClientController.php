<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    public function index()
    {
        if (Gate::denies('manage-clients')) {
            abort(403);
        }

        return view('employee.clients.index');
    }
}
