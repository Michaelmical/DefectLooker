<?php

namespace App\Http\Controllers;
use App\Build;
use http\Env\Response;
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

        $buildData = DB::table('build')
            ->join('project', 'build.proj_id', '=', 'project.proj_id')
            ->select('build.*', 'project.proj_name')
            ->get();

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

        $validator = Validator::make($request->input(), array(
            'inputProject' => 'required',
            'inputMajorId' => 'required',
            'inputMinorId' => 'required',
            'inputDropId' => 'required|unique:Build,drop_id,NULL,id,proj_id,'.$request->inputProject.',major_id,'.$request->inputMajorId.',minor_id,'.$request->inputMinorId,
            'inputDescription' => 'required:max:255',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $buildData = new Build;
        $buildData->proj_id  = $request->inputProject;
        $buildData->major_id  = $request->inputMajorId;
        $buildData->minor_id  = $request->inputMinorId;
        $buildData->drop_id  = $request->inputDropId;
        $buildData->descr  = strtoupper($request->inputDescription);

        $buildData->save();

        //return redirect()->route('build');

        return response()->json([
            'error' => false,
            'task'  => $buildData,
        ], 200);

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

        $buildData = DB::table('build')
            ->join('project', 'build.proj_id', '=', 'project.proj_id')
            ->select('build.*', 'project.proj_name')
            ->where('build.build_id',$id)
            ->first();

        return view('build-show',
            [
                'build' => $buildData

            ]);

    }

    public function edit($id)
    {

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
        $build->major_id  = $request->inputSP;
        $build->minor_id  = $request->inputVS;
        $build->drop_id  = $request->inputDrop;
        $build->descr  = $request->inputDescr;

        $build->save();

        return redirect()->route('build');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Build::findorfail($id);
        $data->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);

    }
}
