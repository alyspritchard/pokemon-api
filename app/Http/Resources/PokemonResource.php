<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "generation_id" => $this->generation()->pluck("name")->implode('generation_id'),
            "types" => $this->types->pluck("name")->implode(', ', 'types'), 
        ];
    }
}
