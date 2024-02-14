<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //validate user input
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'db_type' => 'required|string|max:255'
        ]);

        //create a project
        $project = Project::create($validated_data);

        //set owner
        $project->user_id = auth()->id();
        $project->save();

        //flash and redirect
        session()->flash('message', 'New project created!');
        return redirect(route('projects.edit', ['project'=>$project->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get project
        $project = Project::findOrFail($id);

        //check if project is owned by user
        if (request()->user()->cannot('show', $project)) {
            abort(403);
        }

        //return view
        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        //get project
        $project = Project::findOrFail($id);

        //check if project is owned by user
        if (request()->user()->cannot('update', $project)) {
            abort(403);
        }

        //return view
        return view('layouts.dashboard', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'db_type' => 'required|string|max:255'
        ]);

        //get project
        $project = Project::findOrFail($id);

        //check if project is owned by user
        if (auth()->user()->cannot('update', $project)) {
            abort(403);
        }

        //update project
        $project->update($validated_data);

        //return view
        return redirect()->route('projects.edit', ['project' => $project]);
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

    public function editor(string $id){

        //get project
        $project = Project::findOrFail($id);

        //check if project is owned by user
        if (request()->user()->cannot('update', $project)) {
            abort(403);
        }

        //return view
        return view('projects.editor', ['project' => $project]);
    }

    public function settings(string $id){

        //get project
        $project = Project::findOrFail($id);

        //check if project is owned by user
        if (request()->user()->cannot('update', $project)) {
            abort(403);
        }

        //return view
        return view('projects.settings', ['project' => $project]);
    }

    public function none_selected(){
        return view('layouts.dashboard');
    }
}
