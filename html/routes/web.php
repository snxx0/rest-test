<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Pagina de indicios
$router->get('/', function () use ($router) {
    $data = ["version" => $router->app->version()];
    return view('index', $data);
});

if(config('app.auth')){
    Route::group([
        'prefix' => 'auth'
    ], function ($router) {    
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');    
    });
}

$opt_articulos = [ 'prefix' => 'articulo' ];
if(config('app.auth')) $opt_articulos['middleware'] = 'auth';
Route::group($opt_articulos, function ($router) {
    $router->get('/', 'ArticuloController@listar');
    $router->get('/{id}', 'ArticuloController@obtener');
    $router->post('/', 'ArticuloController@actualizar');
    $router->put('/{id}', 'ArticuloController@actualizar');
    $router->delete('/{id}', 'ArticuloController@borrar');
    $router->post('/upload/{id}', 'ArticuloController@subir_imagen');
    $router->post('/cambio/{id}/{usuario}', 'ArticuloController@cambiar');
});
