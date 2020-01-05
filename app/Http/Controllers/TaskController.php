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
            'sTaskId'         => 'required',
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
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
