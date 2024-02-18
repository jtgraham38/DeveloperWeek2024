<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Build;
use App\Models\Project;


class BuildController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        //validate data
        $validated_data = $request->validate([
            'project_id' => 'required|exists:projects,id'
        ]);

        //get project
        $project = Project::with('entities.attributes')->findOrFail($validated_data['project_id']);

        //check if project is owned by user
        if (request()->user()->cannot('build', $project)) {
            abort(403);
        }

        //render app.py
        $rendered_app = view('_api_builds.flask.app', ['project' => $project])->render();

        //render database.py
        $rendered_database = view('_api_builds.flask.database', ['project' => $project])->render();

        //render schema.py
        $rendered_schema = view('_api_builds.flask.schema', ['project' => $project])->render();

        //render requirements.txt
        $rendered_requirements = view('_api_builds.flask.requirements', ['project' => $project])->render();

        //make app.py, database.py, schema.py, and requirements.txt downloadable
        Storage::disk('local')->put('builds/app.py', $rendered_app);
        Storage::disk('local')->put('builds/database.py', $rendered_database);
        Storage::disk('local')->put('builds/schema.py', $rendered_schema);
        Storage::disk('local')->put('builds/requirements.txt', $rendered_requirements);

        //make the build record
        $build = Build::create($validated_data);
        
        //return view
        dd($rendered_requirements);
        return $rendered_app;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get project
        $project = Project::findOrFail($id);

        //check if project is owned by user
        if (request()->user()->cannot('destroy', $project)) {
            abort(403);
        }

        //return view
        //TODO
    }
}
