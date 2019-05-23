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

$router->get('/', function () use ($router) {
    return file_get_contents('../resources/views/index.html');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'UserController@register');
    $router->group(['middleware' => 'password-auth'], function () use ($router) {
        $router->post('login', 'UserController@login');
    });
    $router->group(['middleware' => 'client'], function () use ($router) {
        $router->get('users/{id}', 'UserController@getDetails');
    });
});
