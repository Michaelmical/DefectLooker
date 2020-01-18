<?php

namespace App\Http\Controllers;

use App\ItemCriteria;
use App\PointsItem;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FunctionPointsController extends Controller
{
    public function index()
    {
        if (session()->get('grpid') === 1) {
            $query = DB::table('task')
                ->join('pointsitem', 'pointsitem.task_id', '=', 'task.task_id')
                ->join('itemcriteria', 'pointsitem.itemcriteria_id', '=', 'itemcriteria.itemcriteria_id')
                ->join('complex', 'itemcriteria.complex_id', '=', 'complex.complex_id')
                ->join('employee', 'task.emp_id', '=', 'employee.emp_id')
                ->groupBy('task.task_id')->selectRaw('task.task_id, CONCAT(employee.last_name, ", ", employee.first_name, " ", employee.middle_name) as wholename, task.name, SUM(complex.weight) AS points, SUM(complex.weight) * .1 as allowable ')
                ->get();
        } else {
            $query = DB::table('task')
                ->join('pointsitem', 'pointsitem.task_id', '=', 'task.task_id')
                ->join('itemcriteria', 'pointsitem.itemcriteria_id', '=', 'itemcriteria.itemcriteria_id')
                ->join('complex', 'itemcriteria.complex_id', '=', 'complex.complex_id')
                ->join('employee', 'task.emp_id', '=', 'employee.emp_id')
                ->where('task.emp_id', '=', session()->get('empid'))
                ->groupBy('task.task_id')->selectRaw('task.task_id, CONCAT(employee.last_name, ", ", employee.first_name, " ", employee.middle_name) as wholename, task.name, SUM(complex.weight) AS points, SUM(complex.weight) * .1 as allowable ')
                ->get();
        }
        return view('functionpoints',
            ['tasks' => $query]);
    }

    public function create()
    {
        if (session()->get('grpid') === 1) {
            $taskData = DB::table('task')->where('has_functionpts', '=', 0)->get();
        } else {
            $taskData = DB::table('task')->where('has_functionpts', '=', 0)
                ->where('emp_id', '=', session()->get('empid'))->get();
        }
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
        $aComplexIds = $request->inputComplex;
        $aExistingItemCriteriaData = [];
        foreach ($aComplexIds as $sKey => $iValue) {
            $oItemCriteria = new ItemCriteria;
            $oItemCriteria->complex_id = $iValue;
            $oItemCriteria->save();
            array_push($aExistingItemCriteriaData, $oItemCriteria->itemcriteria_id);
        }

        $aComplexIds = $request->inputAssoItem;
        foreach ($aExistingItemCriteriaData as $aData => $iValue) {
            $oPtsItem = new PointsItem;
            $oPtsItem->name = $aComplexIds[$aData];
            $oPtsItem->task_id = $request->inputProject;
            $oPtsItem->itemcriteria_id = $iValue;
            $oPtsItem->save();
        }

        $oTaks = Task::find($request->inputProject);
        $oTaks->has_functionpts = 1;
        $oTaks->save();

        return redirect()->route('functionpoints');
    }

    public function edit($taskid)
    {
        $oTask = new Task;
        return $oTask->join('pointsitem', 'pointsitem.task_id', '=', 'task.task_id')
            ->join('itemcriteria', 'pointsitem.itemcriteria_id', '=', 'itemcriteria.itemcriteria_id')
            ->join('complex', 'itemcriteria.complex_id', '=', 'complex.complex_id')
            ->join('areatype', 'complex.areatype_id', '=', 'areatype.areatype_id')
            ->join('area', 'areatype.area_id', '=', 'area.area_id')
            ->where('task.task_id', $taskid)
            ->selectRaw('task.task_id as task_id, area.descr as areaname, areatype.descr as areatypename, pointsitem.name as filename, complex.weight as pts')
            ->get();
    }
}
