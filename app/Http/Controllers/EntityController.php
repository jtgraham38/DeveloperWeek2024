<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($project_id)
    {
        $project = DB::table('projects')->where('id', '=', $project_id)->get();
        if (!reset($project)) {
            return [];
        }

        $project = $project->first();

        return DB::table('entities')->where('project_id', '=', $project_id)->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($project_id)
    {
        $project = DB::table('projects')->where('id', '=', $project_id)->get();
        if (!reset($project)) {
            abort(404);
        }

        $project = $project->first();

        return view('entity.create-entity', [
            'project' => $project
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($project_id, Request $request)
    {
        $entity = DB::table('entities')->insertGetId([
            'name' => $request->get('entity-name'),
            'description' => $request->get('entity-description'),
            'table_name' => $request->get('table-name'),
            'is_private' => $request->get('is-private'),
            'project_id' => $project_id
        ]);
        $entity_attribute_type = [];
        $request->collect('column-datatype')->each(function(string $type) {
            $entity_attribute_type[] = $type;
        });
        $entity_attribute_name = [];
        $request->collect('column-name')->each(function(string $name) {
            $entity_attribute_name[] = $name;
        });
        foreach ($entity_attribute_name as $i => $name) {
            DB::table('entity_attributes')->insert([
                'name' => $name,
                'type' => $entity_attribute_type[$i],
                'is_key' => false,
                'is_foreign' => false,
                'entity_id' => $entity,
            ]);
        }
        return route('projects.edit', [ $project_id ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($project_id, Entity $entity)
    {
        $entity = DB::table('entities')->where('id', '=', $entity)->where('project_id', '=', $project_id)->get();
        if (count($entity) != 1) {
            abort(404);
        }
        return view('entity.show-entity', [
            'data' => $entity,
            'project_id' => $project_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entity $entity)
    {
        //
    }
}
