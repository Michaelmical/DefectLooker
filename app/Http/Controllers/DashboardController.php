<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $userId = session('empid');
        $userData = User::find($userId)->first();
        $empData = Employee::find($userData['emp_id'])->first();

        return view('dashboard', [
            'employee' => $empData,
                'user' => $userData
            ]
        );

    }
}
