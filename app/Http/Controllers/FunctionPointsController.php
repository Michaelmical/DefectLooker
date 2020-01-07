<?php

namespace App\Http\Controllers;

use App\ItemCriteria;
use App\PointsItem;
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
        $aComplexIds = $request->inputComplex;
        $aExistingItemCriteriaData = [];
        foreach ($aComplexIds as $sKey => $iValue) {
            $oItemCriteria = new ItemCriteria;
            $oItemCriteria->complex_id = $iValue;
            $oItemCriteria->save();
            array_push($aExistingItemCriteriaData, $oItemCriteria->itemcriteria_id);
        }
//        return $aExistingItemCriteriaData;

        $aComplexIds = $request->inputAssoItem;
        foreach ($aExistingItemCriteriaData as $aData => $iValue) {
            $oPtsItem = new PointsItem;
            $oPtsItem->name = $aComplexIds[$aData];
            $oPtsItem->task_id = $request->inputProject;
            $oPtsItem->itemcriteria_id = $iValue;
            $oPtsItem->save();
        }


    }
}
