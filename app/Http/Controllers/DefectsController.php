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

        $query = DB::table('task')
            ->join('defects', 'task.task_id', '=', 'defects.orig_ref_id')
            ->groupBy('task.task_id')->selectRaw('task.task_id as taskid, task.name as descr, COUNT(*) as points, 1 as allowable')
            ->get();

        foreach ($query as $task)
        {
            $query2 = DB::table('task')
                ->join('pointsitem', 'pointsitem.task_id', '=', 'task.task_id')
                ->join('itemcriteria', 'pointsitem.itemcriteria_id', '=', 'itemcriteria.itemcriteria_id')
                ->join('complex', 'itemcriteria.complex_id', '=', 'complex.complex_id')
                ->where('task.task_id','=',$task->taskid)
                ->groupBy('task.task_id')->selectRaw('SUM(complex.weight) * .1 as points')
                ->get();

            foreach ($query2 as $points)
            {
                $task->allowable = $points->points;
            }

        }

        return  view('defects',
            ['tasks' => $query]
        );

    }

    public function create()
    {
        //
        $defectedItems = array();
        $defects = DB::table('defects')->get();
        foreach ($defects as $defect) {
            $defectedItems[] = $defect->task_id;
        }
        //return $defects;
        $bugData = DB::table('task')->where('inc_type','BUG')->whereNotIn('task_id',$defectedItems)->get();
        $taskData = DB::table('task')->get();
        $defectTypes = DB::table('defect_type')->get();
        $defectCauses = DB::table('defect_cause')->get();

        return view('defects-create',
            [
                'buglist' => $bugData,
                'tasklist' => $taskData,
                'defecttypelist' => $defectTypes,
                'defectcauselist' => $defectCauses
            ]
        );

        return redirect()->route('defects');

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
        $buildData->area_category  = $request->areacategory;
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
