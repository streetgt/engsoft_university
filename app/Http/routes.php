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

$app->get('test','StudentController@test');

$app->group(['middleware' => 'token', 'prefix' => 'api'], function () use ($app) {

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
        $app->group(['prefix' => '{id}/grade'], function () use ($app) {
            $app->get('/', 'StudentController@getGrades');
            //$app->get('/{id}/add', 'StudentController@getGrades');
        });

        /* Schedule */
        $app->get('/{id}/schedule', 'ScheduleController@getUserSchedule');

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

    $app->group(['prefix' => 'room'], function () use ($app) {
        $app->group(['middleware' => 'instructor'], function () use ($app) {
            $app->get('/free', 'RoomController@getRoomsFree');
        });

        $app->group(['middleware' => 'employee'], function () use ($app) {
            $app->get('/', 'RoomController@index');
            $app->get('{id}', 'RoomController@getRoom');
            $app->post('/', 'RoomController@createRoom');
            $app->put('{id}', 'RoomController@updateRoom');
            $app->delete('{id}', 'RoomController@deleteRoom');

            $app->get('{id}/occupied', 'RoomController@getRoomOccupiedInformation');
        });
    });

    $app->group(['middleware' => 'instructor', 'prefix' => 'instructor'], function () use ($app) {
        $app->post('grade', 'GradeController@createGrade');
    });

    $app->group(['middleware' => 'instructor', 'prefix' => 'grade'], function () use ($app) {
        $app->get('/', 'GradeController@index');
        $app->get('{id}', 'GradeController@getGrade');
        $app->post('/', 'GradeController@createGrade');
        $app->put('{id}', 'GradeController@updateGrade');
        $app->delete('{id}', 'GradeController@deleteGrade');
    });

    $app->group(['middleware' => 'student', 'prefix' => 'schedule'], function () use ($app) {
        $app->get('/', 'ScheduleController@index');
        $app->get('{id}', 'ScheduleController@getSchedule');
        $app->post('/', 'ScheduleController@createSchedule');
        $app->put('{id}', 'ScheduleController@updateSchedule');
        $app->delete('{id}', 'ScheduleController@deleteSchedule');

        $app->get('{id}/user', 'ScheduleController@getUserSchedule');
    });
});