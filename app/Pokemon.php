<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Pokemon extends Model
{
    protected $fillable = ["name", "generation_id"];

    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }

    public function types()
    {
		return $this->belongsToMany(Type::class);
	}

	public function setTypes(Collection $types)
	{
		// update the pivot table with type IDs
		$this->types()->sync($types->pluck("id")->all());
		return $this;
	}
}
