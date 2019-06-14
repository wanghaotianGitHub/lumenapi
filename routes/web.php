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
    return $router->app->version();
});
$router->post('login','User\UserController@login');
$router->post('reg','User\UserController@reg');
$router->post('wxEvent','User\UserController@wxEvent');
$router->post('changepwd','User\UserController@changepwd');
$router->post('mi','User\UserController@mi');
$router->post('Symmetric','User\UserController@Symmetric');
$router->post('FSymmetric','User\UserController@FSymmetric');