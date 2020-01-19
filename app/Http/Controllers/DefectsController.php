<?php

namespace App\Http\Controllers;

use App\Defects;
use Illuminate\Support\Facades\Validator;
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

        $defectTypes = DB::table('defect_type')->get();
        $defectCauses = DB::table('defect_cause')->get();
        $projects = DB::table('project')->get();

        return view('defects-create',
            [
                'projectlist' => $projects,
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

        $validator = Validator::make($request->input(), array(
            'inputProjectId' =>'required',
            'inputBuildId' => 'required',
            'inputOrigRefNo' => 'required',
            'inputDefectType' => 'required',
            'inputDefectCause' => 'required',
            'inputAreaCategory' => 'required',
            'inputRemarks' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $buildData = new Defects;
        $buildData->task_id  = $request->inputBuildId;
        $buildData->orig_ref_id  = $request->inputOrigRefNo;
        $buildData->defect_type_id  = $request->inputDefectType;
        $buildData->defect_cause_id  = $request->inputDefectCause;
        $buildData->area_category  = $request->inputAreaCategory;
        $buildData->remarks  = $request->inputRemarks;

        $buildData->save();

        return response()->json([
            'error' => false,
            'task'  => $buildData,
        ], 200);

        //return redirect()->route('defects');
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

        $data = DB::table('defects')
            ->join('task', 'defects.task_id', '=', 'task.task_id')
            ->join('defect_cause', 'defects.defect_cause_id', '=', 'defect_cause.defect_cause_id')
            ->join('defect_type', 'defects.defect_type_id', '=', 'defect_type.defect_type_id')
            ->where('defects.orig_ref_id','=',$id)
            ->groupBy('task.task_id')
            ->selectRaw('defects.orig_ref_id as origtaskid, defects.task_id as taskid, task.name as descr , defect_type.desc_type as defecttypedescr, defect_cause.desc_cause as defectcausedescr, defects.area_category as area, defects.remarks as remarks, defects.created_at')
            ->get();

        //return response()->json($data);

        return  view('defects-show',
            [
                'tasks' => $data,
                'origtaskid' => $id
            ]
        );

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

    public function build($id)
    {

        $data = DB::table('project')
            ->join('build', 'project.proj_id', '=', 'build.proj_id')
            ->join('task', 'build.build_id', '=', 'task.build_id')
            ->where('task.inc_type','=','BUG')
            ->where('project.proj_id','=',$id)
            ->whereNotIn('task.task_id',
                function ($query){
                    $query->select('defects.task_id')->from('defects');
                })
            ->groupBy('task.task_id')->selectRaw('task.task_id as taskid, task.name as descr')
            ->get();

        return response()->json($data);
    }

    public function original($id)
    {

        $data = DB::table('project')
            ->join('build', 'project.proj_id', '=', 'build.proj_id')
            ->join('task', 'build.build_id', '=', 'task.build_id')
            ->where('task.task_id','=',$id)
            ->groupBy('task.task_id')->selectRaw('task.task_id as taskid, build.build_id as buildid, project.proj_id as projid')
            ->first();

        $projID = $data->projid;
        $buildID = $data->buildid;

        $query = DB::table('project')
            ->join('build', 'project.proj_id', '=', 'build.proj_id')
            ->join('task', 'build.build_id', '=', 'task.build_id')
            ->where('build.build_id','!=',$buildID)
            ->where('project.proj_id','=',$projID)
            ->groupBy('task.task_id')
            ->selectRaw('task.task_id as taskid, build.build_id as buildid, project.proj_id as projid')
            ->get();

        return response()->json($query);
    }



}
