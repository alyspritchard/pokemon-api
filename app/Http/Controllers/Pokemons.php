<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pokemon;
use App\Generation;
use App\Type;

use App\Http\Requests\PokemonRequest;

use App\Http\Resources\PokemonResource;

class Pokemons extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PokemonResource::collection(Pokemon::all());
    }

    public function generationIndex(Generation $generation)
    {
        return $generation->pokemons;
    }

    public function typeIndex(Type $type)
    {
        return $type->pokemons;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PokemonRequest $request)
    {
        $data = $request->only(["name", "generation_id"]);

        $pokemon = Pokemon::create($data);

        $types = Type::parse($request->get("types"));
        $pokemon->setTypes($types);

        return new PokemonResource($pokemon);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pokemon $pokemon)
    {
        return new PokemonResource($pokemon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PokemonRequest $request, Pokemon $pokemon)
    {
        // get the request data
        $data = $request->only(["name", "generation_id"]);

        // update the pokemon
        $pokemon->fill($data)->save();

        $types = Type::parse($request->get("types"));
        $pokemon->setTypes($types);

        // return the resource
        return new PokemonResource($pokemon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return response(null, 204);
    }
}
