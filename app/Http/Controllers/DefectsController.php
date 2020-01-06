<?php

namespace App\Http\Controllers;

use App\Defects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $defects = DB::table('defects')->get();
        $defectTypes = DB::table('defect_type')->get();
        $defectCauses = DB::table('defect_cause')->get();

        return view('defects',
            [
                'defectslist' => $defects,
                'defecttypelist' => $defectTypes,
                'defectcauselist' => $defectCauses
            ]
        );

    }

    public function create()
    {
        //

        $taskData = DB::table('task')->get();
        $defectTypes = DB::table('defect_type')->get();
        $defectCauses = DB::table('defect_cause')->get();

        return view('defects-create',
            [
                'tasklist' => $taskData,
                'defecttypelist' => $defectTypes,
                'defectcauselist' => $defectCauses
            ]
        );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'bugid' => 'required',
            'origrefno' => 'required',
            'defecttype' => 'required',
            'defectcause' => 'required',
            'areacategory' => 'required',
            'remarks' => 'required',
        ]);

        $buildData = new Defects;
        $buildData->task_id  = $request->bugid;
        $buildData->orig_ref_id  = $request->origrefno;
        $buildData->defect_type_id  = $request->defecttype;
        $buildData->defect_cause_id  = $request->defectcause;
        $buildData->area_category  = $request->remarks;
        $buildData->remarks  = $request->remarks;

        $buildData->save();

        return redirect()->route('build');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
