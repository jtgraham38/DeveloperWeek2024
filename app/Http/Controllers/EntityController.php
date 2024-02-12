<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($build_id)
    {
        $build = DB::table('builds')->where('id', '=', $build_id)->get();
        if (count($build) != 1) {
            abort(404);
        }
        $build = $build[0];
        return view('crud.list-entities', [
            'data' => DB::table('entities')->where('build_id', '=', $build_id)->get(),
            'build' => $build
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($build_id)
    {
        return view('crud.create-entity', [
            'build_id' => $build_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($build_id, Request $request)
    {
        $entity = DB::table('entities')->insertGetId([
            'name' => $request->get('entity-name'),
            'description' => $request->get('table-description'),
            'table_name' => $request->get('table-name'),
            'is_private' => $request->get('is-private'),
            'build_id' => $build_id
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
        return route('entity.show', [ $build_id, $entity ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($build_id, Entity $entity)
    {
        $entity = DB::table('entities')->where('id', '=', $entity)->where('build_id', '=', $build_id)->get();
        if (count($entity) != 1) {
            abort(404);
        }
        return view('crud.show-entity', [
            'data' => $entity,
            'build_id' => $build_id
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
