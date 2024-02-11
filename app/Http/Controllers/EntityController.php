<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        info("POST recieved {data}", ["data" => $request]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Entity $entity)
    {
        //
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
