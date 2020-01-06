<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function registration()
    {
        return view('registration');
    }

    public function postLogin(Request $request)
    {
        //return Hash::make('user1pass');
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $employee = Employee::where('emp_id', $user['id'])->first();

            if (empty($user) === false) {
                session([
                    'empid' => $user['emp_id'],
                    'empno' => $user['emp_number'],
                    'grpid' => $user['grp_id'],
                    'full_name' => $employee['last_name'],
                    'userImage' => $employee['image_path']
                ]);
                session()->save();
            }

            return redirect('dashboard');

        }else{
            return redirect()->route('login');
        }

    }

    public function sessionhere()
    {
        return session()->all();
    }

//    public function postRegistration(Request $request)
//    {
//        request()->validate([
//            'name' => 'required',
//            'email' => 'required|email|unique:users',
//            'password' => 'required|min:6',
//        ]);
//
//        $data = $request->all();
//
//        $check = $this->create($data);
//
//        return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
//    }
//
    public function dashboard()
    {
        if(Auth::check()){
           return view('dashboard');
      }
        //return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }
//
//    public function create(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password'])
//        ]);
//    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
