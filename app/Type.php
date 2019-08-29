<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Type extends Model
{
	public $timestamps = false;
    protected $fillable = ["name"];

    public function pokemons()
	{
		return $this->belongsToMany(Pokemon::class);
	}

	public static function parse(array $types)
	{
		// turns into a collection and maps over
		return collect($types)->map(function ($type) 
		{
			// remove any blank spaces either side
			$string = trim($type);
			return static::makeType($string);
		});

	}

	private static function makeType($string)
	{
		// check if type already exists
		$exists = Type::where("name", $string)->first();
		// if type exists return it, otherwise create a new one
		return $exists ? $exists : Type::create(["name" => $string]);
	}
}
