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

use App\Http\Controllers\LinkController;

$router->get('/create-link', ['uses' => 'LinkController@createLink']);
$router->get('/{name}', ['uses' => 'LinkController@getLink']);
//$router->get('/list-links', ['uses' => 'LinkController@listLinks']);
//$router->post('/edit-link', ['uses' => 'LinkController@editLink']);





