<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use ZipArchive;

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

        //make the build record
        $build = Build::create($validated_data);

        //save app.py, database.py, schema.py, and requirements.txt to their appropriate directory
        $save_path = 'builds/user_' . auth()->id() . '/build_' . $build->id . '/';
        Storage::disk('local')->put($save_path . 'app.py', $rendered_app);
        Storage::disk('local')->put($save_path . 'database.py', $rendered_database);
        Storage::disk('local')->put($save_path . 'schema.py', $rendered_schema);
        Storage::disk('local')->put($save_path . 'requirements.txt', $rendered_requirements);

        //return view
        session()->flash('message', 'Build complete!');
        return redirect()->route('projects.edit', ['project' => $project]);
    }

    //download a build
    public function download(string $id)
    {
        //get buid
        $build = Build::findOrFail($id);

        //check if build is owned by user
        if (request()->user()->cannot('download', $build)) {
            abort(403);
        }

        //locate files to zip, and name for zip
        $zip_name = 'build.zip';

        //make zip file
        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/builds/user_' . auth()->id() . '/build_' . $build->id . '/' . $zip_name), ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            
            //need app/ above but not below
        
            $files = Storage::files('builds/user_' . auth()->id() . '/build_' . $build->id . '/'); //get paths to all files in the designated directory

            foreach ($files as $file) {
                $file_path = Storage::path($file);
                $relative_path = basename($file);
                $zip->addFile($file_path, $relative_path);

            }

            $zip->close();
        }

        //return zip file as a download
        return response()->download(storage_path('app/builds/user_' . auth()->id() . '/build_' . $build->id . '/' . $zip_name))->deleteFileAfterSend(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get buid
        $build = Build::with('project')->findOrFail($id);

        //check if build is owned by user
        if (request()->user()->cannot('destroy', $build)) {
            abort(403);
        }

        //delete the folder with the build in it
        Storage::deleteDirectory('builds/user_' . auth()->id() . '/build_' . $build->id);

        //delete the db record
        $build->delete();

        //return view
        session()->flash('message', 'Build deleted!');
        return redirect()->route('projects.edit', ['project' => $build->project]);
    }
}
