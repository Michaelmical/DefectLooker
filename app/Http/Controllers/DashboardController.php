<?php

namespace App\Http\Controllers;

use App\Defects;
use App\Employee;
use App\PointsItem;
use App\Project;
use App\User;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $userId = session('empid');
        $userData = User::find($userId)->first();
        $empData = Employee::find($userData['emp_id'])->first();

        $countTask = Task::count();
        $countFP = PointsItem::distinct('task_id')->count('task_id');
        $countDefects = Defects::count();

        return view('dashboard',
            [
            'employee' => $empData,
                'user' => $userData,
                'countTask' => $countTask,
                'countFP' => $countFP,
                'countDefects' => $countDefects,
                'existingProject' => Project::all()
            ]
        );
        //SELECT *, SUM(C.weight) * .10 as ALLOWABLE FROM project PR INNER JOIN build B ON B.proj_id = PR.proj_id INNER JOIN task T ON T.build_id = B.build_id INNER JOIN pointsitem P ON P.task_id = T.task_id INNER JOIN itemcriteria I ON P.itemcriteria_id = I.itemcriteria_id INNER JOIN complex C ON I.complex_id = C.complex_id GROUP BY b.build_id
    }

    public function showLineChart(Request $request)
    {
        $iProjID = $request->get('iProjID');
        $buildData = DB::table('project')
            ->join('build', 'build.proj_id', '=', 'project.proj_id')
            ->join('task', 'task.build_id', '=', 'build.build_id')
            ->join('pointsitem', 'pointsitem.task_id', '=', 'task.task_id')
            ->join('itemcriteria', 'pointsitem.itemcriteria_id', '=', 'itemcriteria.itemcriteria_id')
            ->join('complex', 'itemcriteria.complex_id', '=', 'complex.complex_id')
            ->where('project.proj_id','=', $iProjID)
            ->groupBy('build.build_id')->selectRaw('build.*, SUM(complex.weight) * .10 as allowable')
            ->get();

        $aActual = DB::table('defects')
            ->join('task', 'defects.task_id', '=', 'task.task_id')
            ->join('build', 'task.build_id', '=', 'build.build_id')
            ->join('project', 'build.proj_id', '=', 'project.proj_id')
            ->where('project.proj_id', '=', $iProjID)
            ->groupBy(['defects.orig_ref_id', 'project.proj_id'])->selectRaw('build.*, COUNT(defects.orig_ref_id) as actual')
            ->get();
//        return $aActual;
        return response()->json([
            'build'  => $buildData,
            'actual' => $aActual
        ]);
    }

    public function showBarChart(Request $request)
    {
        $iProjID = $request->get('iProjID');
    }

}
