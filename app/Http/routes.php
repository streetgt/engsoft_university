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
    $app->group(['prefix' => 'json'], function () use ($app) {

        $app->group(['prefix' => 'student'], function () use ($app) {
            $app->get('/','StudentController@index');
            $app->get('{id}','StudentController@getStudent');
            $app->post('/','StudentController@createStudent');
            $app->put('{id}','StudentController@updateStudent');
            $app->delete('{id}','StudentController@deleteStudent');
        });

        $app->group(['prefix' => 'course'], function () use ($app) {
            $app->get('/','CourseController@index');
            $app->get('{id}','CourseController@getCourse');
            $app->post('/','CourseController@createCourse');
            $app->put('{id}','CourseController@updateCourse');
            $app->delete('{id}','CourseController@deleteCourse');

            $app->get('{id}/disciplines','CourseController@getCourseDisciplines');
        });

        $app->group(['prefix' => 'discipline'], function () use ($app) {
            $app->get('/','DisciplineController@index');
            $app->get('{id}','DisciplineController@getDiscipline');

            $app->get('{id}/courses','DisciplineController@getDisciplineCourses');
        });
    });


});