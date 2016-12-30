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

$app->get('test', 'StudentController@test');

$app->group(['prefix' => 'api'], function () use ($app) {
    $app->group(['prefix' => 'json'], function () use ($app) {

        $app->group(['prefix' => 'user'], function () use ($app) {
            $app->get('/', 'UserController@index');
            $app->get('{id}', 'UserController@getUser');
            $app->post('/', 'UserController@createUser');
            $app->put('{id}', 'UserController@updateUser');
            $app->delete('{id}', 'UserController@deleteUser');
        });

        $app->group(['prefix' => 'student'], function () use ($app) {
            $app->get('/', 'StudentController@index');
            $app->get('{id}', 'StudentController@getStudent');
            $app->post('/', 'StudentController@createStudent');
            $app->put('{id}', 'UserController@updateUser');
            $app->delete('{id}', 'StudentController@deleteStudent');

            /* Grades */
            $app->get('/{id}/grade', 'StudentController@getGrades');

            /* Course */
            $app->group(['prefix' => '{id}/course'], function () use ($app) {
                $app->get('/', 'StudentController@getCourses');
                $app->post('/enroll', 'StudentController@enrollCourse');
            });

            /* Discipline */
            $app->group(['prefix' => '{id}/classe'], function () use ($app) {
                $app->get('/', 'StudentController@getClasses');
                $app->post('/enroll', 'StudentController@enrollDiscipline');
            });

        });

        $app->group(['prefix' => 'course'], function () use ($app) {
            $app->get('/', 'CourseController@index');
            $app->get('{id}', 'CourseController@getCourse');
            $app->post('/', 'CourseController@createCourse');
            $app->put('{id}', 'CourseController@updateCourse');
            $app->delete('{id}', 'CourseController@deleteCourse');

            /* Disciplines */
            $app->get('{id}/disciplines', 'CourseController@getCourseDisciplines');
        });

        $app->group(['prefix' => 'discipline'], function () use ($app) {
            $app->get('/', 'DisciplineController@index');
            $app->get('{id}', 'DisciplineController@getDiscipline');

            /* Courses */
            $app->get('{id}/courses', 'DisciplineController@getDisciplineCourses');
        });

        $app->group(['prefix' => 'room'], function () use ($app) {
            $app->get('/', 'RoomController@index');
            $app->get('{id}', 'RoomController@getRoom');
            $app->post('/', 'RoomController@createRoom');
            $app->put('{id}', 'RoomController@updateRoom');
            $app->delete('{id}', 'RoomController@deleteRoom');
        });
    });
});