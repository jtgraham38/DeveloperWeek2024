<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\EntityAttribute;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
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

        // Get all entities associated with this project
        $entities = app("App\Http\Controllers\EntityController")->index($id);

        //return view
        return view('projects.show', ['project' => $project, 'entities' => $entities]);
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
        session()->flash('message', 'Project updated!');
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
        session()->flash('message', 'Project deleted!');
        //TODO
    }

    public function editor(string $id){

        //get project
        $project = Project::findOrFail($id);

        //check if project is owned by user
        if (request()->user()->cannot('update', $project)) {
            abort(403);
        }

        // Get all entities associated with this project
        $entity_query = Entity::where('project_id', $id);
        $entities = $entity_query->get();

        // Get other entities' attributes
        $entity_attributes = EntityAttribute::whereIn('entity_id', $entity_query->get('id'))->get();
        $other_entities = $entity_query->get()->keyBy('id');

        //return view
        return view('projects.editor', ['project' => $project, 'entities' => $entities, 'entity_attributes' => $entity_attributes, 'other_entities' => $other_entities]);
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

    public function builds($id){
        //get project
        $project = Project::findOrFail($id);

        //check if project is owned by user
        if (request()->user()->cannot('update', $project)) {
            abort(403);
        }

        return view('projects.builds', ['project' => $project]);
    }

}
