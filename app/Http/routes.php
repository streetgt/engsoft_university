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

$app->group(['prefix' => 'api'], function () use ($app) {
    $app->group(['prefix' => 'user'], function () use ($app) {
        $app->get('all', ['as' => 'user.all', 'uses' => 'StudentController@index']);
    });

    $app->group(['prefix' => 'course'], function () use ($app) {
        $app->get('all', ['as' => 'course.all', 'uses' => 'CourseController@index']);
    });
});