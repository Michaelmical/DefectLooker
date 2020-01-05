<?php

namespace App\Http\Controllers;

use App\Build;
use App\Employee;
use App\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\View\View\
     */
    public function index()
    {
        return view('tasks', ['aTaskData' => DB::table('task')
            ->join('build','task.build_id','=', 'build.build_id')
            ->join('employee', 'task.emp_id', '=', 'employee.emp_id')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('task-create', ['aBuildData' => Build::all(), 'aEmpData' => Employee::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            'iBuildId'       => 'required',
            'iEmpId'         => 'required',
            'sTaskId'        => 'required',
            'sIncType'       => 'required',
            'sSeverity'      => 'required',
            'sStartDate'     => 'required',
            'sCompletedDate' => 'required',
            'sDesc'          => 'required'
        ]);

        $aData = Task::create([
            'task_id'      => $request->get('sTaskId'),
            'name'         => $request->get('sDesc'),
            'inc_type'     => $request->get('sIncType'),
            'severity'     => $request->get('sSeverity'),
            'started_at'   => $request->get('sStartDate'),
            'completed_at' => $request->get('sCompletedDate'),
            'emp_id'       => $request->get('iEmpId'),
            'build_id'     => (int)$request->get('iBuildId')
        ]);

        return empty($aData) === true ?
            response()->json([
                'result'  => false,
                'message' => 'Failed'
            ])
            :
            response()->json([
                'result' => true,
                'data'   => $aData
            ]);
    }


    public function show(Task $task, $taskid)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @param $taskid
     * @return Factory|\Illuminate\Http\RedirectResponse|View
     */
    public function edit(Task $task, $taskid)
    {
        $aTaskData = Task::where('task_id', $taskid)->first();

        if (empty($aTaskData) === true) {
            return redirect()->route('tasks');
        }

        $aBuildData = Build::all();
        foreach ($aBuildData as $aData) {
            $aData['active'] = $aData['build_id'] === $aTaskData['build_id'] ? 'active' : '';
        }

        $aIncType = [
            ['types' => 'bug'], ['types' => 'task'], ['types' => 'enhancement']
        ];
        foreach ($aIncType as $aDataItem => $svalue) {
            $aIncType[$aDataItem]['active'] = ($svalue['types'] === $aTaskData['inc_type']) ? 'active' : '';
        }

        $aSeverity = [
            ['type' => 'low'], ['type' => 'medium'], ['type' => 'high']
        ];
        foreach ($aSeverity as $aDataItem => $svalue) {
            $aSeverity[$aDataItem]['active'] = ($svalue['type'] === $aTaskData['severity']) ? 'active' : '';
        }

        $aEmpData = Employee::all();
        foreach ($aEmpData as $aEData) {
            $aEData['active'] = $aEData['emp_id'] === $aTaskData['emp_id'] ? 'active' : '';
        }

        return view('tasks-update', [
            'aBuildData' => $aBuildData,
            'aTaskData'  => $aTaskData,
            'aIncType'   => $aIncType,
            'aSeverity'  => $aSeverity,
            'aEmpData'   => $aEmpData
        ]);
    }


    public function update(Request $request, Task $task, $taskid)
    {
        request()->validate([
            'iBuildId'       => 'required',
            'iEmpId'         => 'required',
            'sTaskId'        => 'required',
            'sIncType'       => 'required',
            'sSeverity'      => 'required',
            'sStartDate'     => 'required',
            'sCompletedDate' => 'required',
            'sDesc'          => 'required'
        ]);

        $aData = $task->where('task_id', $taskid)->first();
        $aData->name =  $request->get('sDesc');
        $aData->inc_type =  $request->get('sIncType');
        $aData->severity =  $request->get('sSeverity');
        $aData->started_at =  $request->get('sStartDate');
        $aData->completed_at =  $request->get('sCompletedDate');
        $aData->build_id =  $request->get('iBuildId');
        $aData->emp_id =  $request->get('iEmpId');
        $aData->save();

        return response()->json($aData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @param $taskid
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task, $taskid)
    {
        $data = Task::findorfail($taskid);
        $data->delete();
        return response()->json($data);
    }
}
