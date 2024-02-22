<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\EntityAttribute;
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
            'display_name' => $input['entity-name'],
            'description' => $input['entity-desc'],
            'singular_name' => $input['singular-name'],
            'multiple_name' => $input['singular-name'] . "s",   //TODO: add input for this
            'table_name' => $input['table-name'],
            'is_private' => $request->has('is-private') ? true : false,
            'project_id' => $project_id
        ]);
        $datatype_key = 'column-datatype-';
        $name_key = 'column-name-';
        $column_is_key_key = 'column-is-key-';
        $column_is_foreign_key_key = 'foreign_attr_id_';

        $rows = $request->integer('row-count');

        for ($i = 1; $i <= $rows; $i++) {
            DB::table('entity_attributes')->insert([
                'type' => $input[$datatype_key.$i],
                'name' => $input[$name_key.$i],
                'is_key' => $request->has($column_is_key_key.$i) ? true : false,
                'foreign_id' => $request->input($column_is_foreign_key_key.$i),
                'entity_id' => $entity
            ]);
        }
        return redirect()->route('projects.edit', [ 'project'=>$project_id, 'p'=>'editor' ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entity $entity)
    {
        $attributes = EntityAttribute::where("entity_id", $entity->id)->get();
        return view('entity.edit-entity', [ "entity" => $entity, "entity_attributes" =>  $attributes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entity $entity)
    {
        $input = $request->all();

        $up_entity = Entity::findOr($entity->id, function() {
            abort(404);
        });

        $up_entity->display_name = $input['entity-name'];
        $up_entity->singular_name = $input['entity-name'];
        $up_entity->multiple_name = $input['entity-name'].'s'; // cheap plural
        $up_entity->description = $input['entity-desc'];
        $up_entity->table_name = $input['table-name'];
        $up_entity->is_private = $request->has('is-private') ? true : false;
        $up_entity->save();

        $attribute_id_key = 'column-id-';
        $datatype_key = 'column-datatype-';
        $name_key = 'column-name-';
        $column_is_key_key = 'column-is-key-';
        $column_is_foreign_key_key = 'column-is-foreign-key-';
        $delete_column_key = 'delete-column-';
        $new_key = 'new-';

        $rows = $request->integer('row-count');

        // Update (or delete) existing entities
        // There's probably a better way of doing this,
        // but I don't have the know-how
        $existing_attrs = EntityAttribute::where('entity_id', $entity->id)->get();
        for ($i = 0; $i < count($existing_attrs); $i++) {
            $attribute = EntityAttribute::find($input[$attribute_id_key.$i]);

            if ($request->has($delete_column_key.$i)) {
                $attribute->delete();
                continue;
            }

            $attribute->name = $input[$name_key.$i];
            $attribute->type = $input[$datatype_key.$i];
            $attribute->is_key = $request->has($column_is_key_key.$i) ? true : false;
            $attribute->is_foreign = $request->has($column_is_foreign_key_key.$i) ? true : false;
            $attribute->save();
        }
        // Create new entities
        for ($i = 1; $i <= $rows; $i++) {
            $attribute = new EntityAttribute;

            $attribute->name = $input[$new_key.$name_key.$i];
            $attribute->type = $input[$new_key.$datatype_key.$i];
            $attribute->is_key = $request->has($new_key.$column_is_key_key.$i) ? true : false;
            $attribute->is_foreign = $request->has($new_key.$column_is_foreign_key_key.$i) ? true : false;
            $attribute->entity_id = $entity->id;
            $attribute->save();
        }

        return redirect()->route('projects.edit', [ $entity->project_id ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entity $entity)
    {
        //
    }
}
