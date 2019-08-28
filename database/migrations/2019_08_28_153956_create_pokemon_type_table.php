<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokemonTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pokemon_type", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("pokemon_id")->unsigned();
            $table->bigInteger("type_id")->unsigned();
            $table->foreign("pokemon_id")->references("id")->on("pokemon")->onDelete("cascade");
            $table->foreign("type_id")->references("id")->on("types")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon_type');
    }
}
