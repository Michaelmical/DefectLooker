<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $empData = employee::all();
        return view('employee', ['employees' => $empData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('employee-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'EmployeeNumber' => 'required|max:8',
            'LastName'       => 'required',
            'FirstName'      => 'required',
            'MiddleName'     => 'required',
            'Nickname'       => 'required',
            'BirthDate'      => 'required',
            'ImageUpload'    => 'required|image|max:2048',
            'Email'          => 'required',
            'Password'       => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $oCheckUser = new User;
        $aExistData = $oCheckUser::where('email', $request->get('Email'))->get();
        if (count($aExistData) > 0) {
            return response()->json([
                'error'    => true,
                'messages' => [
                    'Email' => [
                        'Email already exist.'
                    ]
                ],
            ], 422);
        }

        $image = $request->file('ImageUpload');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $resize_image = Image::make($image->getRealPath());
        $resize_image->resize(200, 200);
        $resize_image->save($destinationPath . '/' . $image_name);

        $oEmployee = new Employee;
        $oEmployee->emp_number = $request->get('EmployeeNumber');
        $oEmployee->last_name = $request->get('LastName');
        $oEmployee->first_name = $request->get('FirstName');
        $oEmployee->middle_name = $request->get('MiddleName');
        $oEmployee->nick_name = $request->get('Nickname');
        $oEmployee->birthdate = $request->get('BirthDate');
        $oEmployee->image_path = $image_name;
        $oEmployee->save();

        $oUser = new User;
        $oUser->email = $request->get('Email');
        $oUser->password = Hash::make($request->get('Password'));
        $oUser->grp_id = 2;
        $oUser->emp_id = $oEmployee->emp_id;
        $oUser->save();

        if ($oEmployee->emp_id === $oUser->id) {
            return response()->json([
                'success' => true,
                'message' => 'Employee Successfully Added'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
