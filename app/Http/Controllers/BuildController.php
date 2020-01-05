<?php

namespace App\Http\Controllers;
use App\Build;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Validator;

class BuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $buildData = DB::table('build')
            ->join('project', 'build.proj_id', '=', 'project.proj_id')
            ->select('build.*', 'project.proj_name')
            ->get();

        //return response()->json($buildData);

        return view('build', ['builds' => $buildData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $projectData = DB::table('project')->get();

        return view('build-create',
            ['projects' => $projectData]);

    }

    public function store(Request $request)
    {
        //

        $validatedData = $request->validate([
            'inputProject' => 'required',
            'inputSP' => 'required',
            'inputVS' => 'required',
            'inputDrop' => 'required',
            'inputDescr' => 'required',
        ]);


        $buildData = new Build;
        $buildData->proj_id  = $request->inputProject;
        $buildData->sp_id  = $request->inputSP;
        $buildData->version_id  = $request->inputVS;
        $buildData->drop_id  = $request->inputDrop;
        $buildData->descr  = $request->inputDescr;

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

    public function edit($id)
    {
        //

        $buildData = DB::table('build')
            ->join('project', 'build.proj_id', '=', 'project.proj_id')
            ->select('build.*', 'project.proj_name')
            ->where('build.build_id',$id)
            ->first();

        $projectData = DB::table('project')->get();

        return view('build-edit',
            [
                'projects' => $projectData,
                'build' => $buildData

            ]);

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
        $build = Build::find($id);

        $build->proj_id  = $request->inputProject;
        $build->sp_id  = $request->inputSP;
        $build->version_id  = $request->inputVS;
        $build->drop_id  = $request->inputDrop;
        $build->descr  = $request->inputDescr;

        $build->save();

        return redirect()->route('build');

        /*return response()->json($request);*/
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
        $data = Build::findorfail($id);
        $data->delete();

        //return response()->json($id);

    }
}
