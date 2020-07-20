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

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->get('/author', 'AuthorController@showAll');
    $router->get('/author/{id}', 'AuthorController@showId');
    $router->post('/author', 'AuthorController@add');
    $router->put('/author/{id}', 'AuthorController@update');
    $router->delete('/author/{id}', 'AuthorController@delete');

    $router->get('/post', 'PostController@showAll');
    $router->get('/post/{id}', 'PostController@showId');
    $router->post('/post', 'PostController@add');
    $router->put('/post/{id}', 'PostController@update');
    $router->delete('/post/{id}', 'PostController@delete');

    $router->get('/comment', 'CommentController@showAll');
    $router->get('/comment/{id}', 'CommentController@showId');
    $router->post('/comment', 'CommentController@add');
    $router->put('/comment/{id}', 'CommentController@update');
    $router->delete('/comment/{id}', 'CommentController@delete');
});