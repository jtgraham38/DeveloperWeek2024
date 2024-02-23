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

        $entity = new Entity;
        $entity->display_name = $input['entity-name'];
        $entity->description = $input['entity-desc'];
        $entity->singular_name = $input['singular-name'];
        $entity->multiple_name = $input['singular-name'] . "s";   //TODO: add input for this
        $entity->table_name = $input['table-name'];
        $entity->is_private = $request->has('is-private') ? true : false;
        $entity->project_id = $project_id;
        $entity->save();

        $datatype_key = 'column-datatype-';
        $name_key = 'column-name-';
        $column_is_key_key = 'column-is-key-';
        $column_is_foreign_key_key = 'column-is-foreign-key-';

        $rows = $request->integer('row-count');

        for ($i = 1; $i <= $rows; $i++) {
            $attribute = new EntityAttribute;
            $attribute->type = $input[$datatype_key.$i];
            $attribute->name = $input[$name_key.$i];
            $attribute->is_key = $request->has($column_is_key_key.$i) ? true : false;
            $attribute->foreign_id = $input[$column_is_foreign_key_key.$i] != "none" ? $request->integer($column_is_foreign_key_key.$i) : null;
            $attribute->entity_id = $entity->getKey();
            $attribute->save();
        }
        return redirect()->route('projects.edit', [ 'project'=>$project_id, 'p'=>'editor' ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Entity $entity)
    {
        $other_attributes = EntityAttribute::whereIn('entity_id', Entity::where('project_id', $project->id)->get('id'))->get();
        $other_entities = Entity::where('project_id', $project->id)->get()->keyBy('id');
        $entity_attributes = EntityAttribute::where("entity_id", $entity->id)->get();
        return view('entity.edit-entity', [
            "entity" => $entity,
            "entity_attributes" =>  $entity_attributes,
            "other_entities" => $other_entities,
            "other_attributes" => $other_attributes
        ]);
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
            $attribute->foreign_id = $input[$column_is_foreign_key_key.$i] != "none" ? $request->integer($column_is_foreign_key_key.$i) : null;
            $attribute->save();
        }
        // Create new entities
        for ($i = 1; $i <= $rows; $i++) {
            $attribute = new EntityAttribute;

            $attribute->name = $input[$new_key.$name_key.$i];
            $attribute->type = $input[$new_key.$datatype_key.$i];
            $attribute->is_key = $request->has($new_key.$column_is_key_key.$i) ? true : false;
            $attribute->foreign_id = $input[$new_key.$column_is_foreign_key_key.$i] != "none" ? $request->integer($new_key.$column_is_foreign_key_key.$i) : null;
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
        $project_id = $entity->project_id;
        $entity->delete();
        return redirect()->route('projects.edit', [ $project_id ]);
    }
}
