<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects = Project::all();

        return view('project',[
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('project-create');

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
            'inputProjectName' => 'required|unique:Project,proj_name'
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $projectData = new Project;
        $projectData->proj_name  = $request->inputProjectName;
        $projectData->save();

        return response()->json([
            'error' => false,
            'task'  => $projectData,
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
        $project = Project::findorfail($id);

        return view('project-show',
            [
                'project' => $project
            ]);
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
        $project = Project::findorfail($id);

        return view('project-edit',
        [
           'project' => $project
        ]);
    }

    public function update(Request $request, $id)
    {

        $query = Project::findorfail($id);

        if ($query->proj_name == $request->inputProjectName)
        {
            $query->proj_name  = $request->inputProjectName;
            $query->save();

            return response()->json([
                'error' => false,
                'task'  => $query,
            ], 200);

        }
        else
        {
            $check = Project::where('proj_name',$request->inputProjectName)->first();

            if (empty($check) === true)
            {
                $query->proj_name  = $request->inputProjectName;
                $query->save();

                return response()->json([
                    'error' => false,
                    'task'  => $query,
                ], 200);

            }
            else
            {
                $errors = [
                    'error' => 'the input project name was already taken.'
                ];

                return response()->json([
                    'error'    => true,
                    'messages' => $errors,
                ], 422);
            }

        }

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
        $data = Project::findorfail($id);
        $data->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
