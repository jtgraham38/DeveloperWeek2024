<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $input = $request->all();

        $entity = DB::table('entities')->insertGetId([
            'name' => $input['entity-name'],
            'description' => $input['entity-desc'],
            'table_name' => $input['table-name'],
            'is_private' => $request->has('is-private') ? true : false,
            'project_id' => $project_id
        ]);
        $datatype_key = 'column-datatype-';
        $name_key = 'column-name-';
        $column_is_key_key = 'column-is-key-';
        $column_is_foreign_key_key = 'column-is-foreign-key-';

        $rows = $request->integer('row-count');

        for ($i = 1; $i <= $rows; $i++) {
            DB::table('entity_attributes')->insert([
                'type' => $input[$datatype_key.$i],
                'name' => $input[$name_key.$i],
                'is_key' => $request->has($column_is_key_key.$i) ? true : false,
                'is_foreign' => $request->has($column_is_foreign_key_key.$i) ? true : false,
                'entity_id' => $entity
            ]);
        }
        return redirect()->route('projects.edit', [ $project_id ]);
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
