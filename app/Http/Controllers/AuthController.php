<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $sEmail = $request->get('email');
        $sPassword = $request->get('password');

        $aUserData = User::where(['email' => $sEmail, 'password' => md5($sPassword)])->first(); // Id ng user userstable


        $aEmpData = Employee::where('emp_id', $aUserData['id'])->first();
//        $sFullname = $aEmpData['last_name'] . ', ' . $aEmpData['first_name'] . ' ' . $aEmpData['middle_name'];

        if (empty($aUserData) === false) {
            session([
                'empid' => $aUserData['emp_id'],
                'empno' => $aEmpData['emp_number'],
                'grpid' => $aUserData['grp_id'],
                'full_name' => $aEmpData['last_name'],
                'userImage' => $aEmpData['image_path']
            ]);
            session()->save();
        }

        return redirect('dashboard');
        //return response()->json($sFullname);

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
