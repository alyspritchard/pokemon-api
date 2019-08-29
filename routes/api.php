<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// pokemon routes
$router->group(["prefix" => "pokemons"], function ($router) {
    $router->get("/", "Pokemons@index");
    $router->post("/", "Pokemons@store")->middleware('auth:api');

    $router->get("{pokemon}", "Pokemons@show");
    $router->put("{pokemon}", "Pokemons@update")->middleware('auth:api');
    $router->delete("{pokemon}", "Pokemons@destroy")->middleware('auth:api');
});

// generation routes
$router->group(["prefix" => "generations"], function ($router) {
    $router->post("/", "Generations@store")->middleware('auth:api');
    $router->get("/", "Generations@index");

    $router->put("{generation}", "Generations@update")->middleware('auth:api');
    $router->delete("{generation}", "Generations@destroy")->middleware('auth:api');

    $router->get("{generation}/pokemons", "Pokemons@generationIndex");
});

// type routes
$router->group(["prefix" => "types"], function ($router) {
    $router->get("{type}/pokemons", "Pokemons@typeIndex");
    $router->get("/", "Types@index");
});
