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

$app->get('test', ['middleware' => 'permissiontoken', 'name', 'test'], 'StudentController@test');

$app->group(['middleware' => 'token', 'prefix' => 'api'], function () use ($app) {
    $app->group(['prefix' => 'json'], function () use ($app) {

        $app->group(['middleware' => 'employee', 'prefix' => 'user'], function () use ($app) {
            $app->get('/', 'UserController@index');
            $app->get('{id}', 'UserController@getUser');
            $app->post('/', 'UserController@createUser');
            $app->put('{id}', 'UserController@updateUser');
            $app->delete('{id}', 'UserController@deleteUser');
        });

        $app->group(['middleware' => 'student', 'prefix' => 'student'], function () use ($app) {
            $app->get('/', 'StudentController@index');
            $app->get('{id}', 'StudentController@getStudent');
            $app->post('/',  ['middleware' => 'employee'], 'StudentController@createStudent');
            $app->put('{id}', 'UserController@updateUser');
            $app->delete('{id}', ['middleware' => 'employee'], 'StudentController@deleteStudent');

            /* Grades */
            $app->get('/{id}/grade', 'StudentController@getGrades');

            /* Course */
            $app->group(['prefix' => '{id}/course'], function () use ($app) {
                $app->get('/', 'StudentController@getCourses');
                $app->post('/enroll', 'StudentController@enrollCourse');
            });

            /* Classes */
            $app->group(['prefix' => '{id}/class'], function () use ($app) {
                $app->get('/', 'StudentController@getClasses');
                $app->post('/enroll', 'StudentController@enrollClass');
            });

        });

        $app->group(['middleware' => 'employee', 'prefix' => 'course'], function () use ($app) {
            $app->get('/', 'CourseController@index');
            $app->get('{id}', 'CourseController@getCourse');
            $app->post('/', 'CourseController@createCourse');
            $app->put('{id}', 'CourseController@updateCourse');
            $app->delete('{id}', 'CourseController@deleteCourse');

            /* Disciplines */
            $app->get('{id}/disciplines', 'CourseController@getCourseDisciplines');
        });

        $app->group(['middleware' => 'employee', 'prefix' => 'discipline'], function () use ($app) {
            $app->get('/', 'DisciplineController@index');
            $app->get('{id}', 'DisciplineController@getDiscipline');

            /* Courses */
            $app->get('{id}/courses', 'DisciplineController@getDisciplineCourses');
        });

        $app->group(['middleware' => 'employee', 'prefix' => 'room'], function () use ($app) {
            $app->get('/', 'RoomController@index');
            $app->get('{id}', 'RoomController@getRoom');
            $app->post('/', 'RoomController@createRoom');
            $app->put('{id}', 'RoomController@updateRoom');
            $app->delete('{id}', 'RoomController@deleteRoom');
        });


        $app->group(['middleware' => 'employee', 'prefix' => 'grade'], function () use ($app) {
            $app->get('/', 'GradeController@index');
            $app->get('{id}', 'GradeController@getGrade');
            $app->post('/', 'GradeController@createGrade');
            $app->put('{id}', 'GradeController@updateGrade');
            $app->delete('{id}', 'GradeController@deleteGrade');
        });
    });
});