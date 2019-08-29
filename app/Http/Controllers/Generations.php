<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generation;
use App\Http\Resources\GenerationResource;
use App\Http\Requests\GenerationRequest;

class Generations extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GenerationResource::collection(Generation::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenerationRequest $request)
    {
        $data = $request->only(["name", "total_pokemon"]);

        $generation = Generation::create($data);

        return response($generation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GenerationRequest $request, Generation $generation)
    {
        // get the request data
        $data = $request->only(["name", "total_pokemon"]);

        // update the generation
        $generation->fill($data)->save();

        // return the resource
        return $generation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Generation $generation)
    {
        $generation->delete();
        return response(null, 204);
    }
}
