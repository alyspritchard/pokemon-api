<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           "name" => ["required", "string", "max:30"],
           "generation_id" => ["required", "integer", "exists:generations,id"],
           "types" => ["required", "array"],
            "types.*" => ["string", "max:30"],
        ];
    }
}
