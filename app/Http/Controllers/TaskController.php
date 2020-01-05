<?php

namespace App\Http\Controllers;

use App\Build;
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
//        $userId = session('empid');
//        $userData = Task::find($userId)->first();
//        $empData = Employee::find($userData['emp_id'])->first();
        return view('tasks', ['aTaskData' => DB::table('task')->join('build','task.build_id','=', 'build.build_id')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('task-create', ['aBuildData' => Build::all()]);
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
            'emp_id'       => (int)session()->get('empid'),
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

        return view('tasks-update', [
            'aBuildData' => $aBuildData,
            'aTaskData'  => $aTaskData,
            'aIncType'   => (object)$aIncType
        ]);
    }


    public function update(Request $request, Task $task, $taskid)
    {
        request()->validate([
            'iBuildId'       => 'required',
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
        $aData->save();

        return response()->json($aData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
