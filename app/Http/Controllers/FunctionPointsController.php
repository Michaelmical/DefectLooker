<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FunctionPointsController extends Controller
{
    //
    public function index()
    {
        $query = DB::table('task')
            ->join('pointsitem', 'pointsitem.task_id', '=', 'task.task_id')
            ->join('itemcriteria', 'pointsitem.itemcriteria_id', '=', 'itemcriteria.itemcriteria_id')
            ->join('complex', 'itemcriteria.complex_id', '=', 'complex.complex_id')
            ->groupBy('task.task_id')->selectRaw('task.task_id, task.name, SUM(complex.weight) AS points, SUM(complex.weight) * .1 as allowable ')
            ->get();
//        return $query;
        return view('functionpoints',
            ['tasks' => $query]);
    }

    public function create()
    {
        $taskData = DB::table('task')->get();
        $areaData = DB::table('area')->get();
        $areatypeData = DB::table('areatype')->get();
        $complex = DB::table('complex')->get();

        return view('functionpoints-create',
            [
                'tasks' => $taskData,
                'areas'=> $areaData,
                'areatypes' => $areatypeData,
                'complexities' => $complex
            ]);
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}
