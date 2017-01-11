<?php

/**
 * Web Services Routes
 */

$app->get('test', 'StudentController@test');

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
        $app->post('/', 'StudentController@createStudent');
        $app->put('{id}', 'UserController@updateUser');
        $app->delete('{id}', 'StudentController@deleteStudent');

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
        $app->post('/', 'DisciplineController@createDiscipline');
        $app->put('{id}', 'DisciplineController@updateDiscipline');
        $app->delete('{id}', 'DisciplineController@deleteDiscipline');

        /* Course */
        $app->group(['prefix' => '{id_discipline}/course'], function () use ($app) {
            $app->post('{id_course}/associate', 'DisciplineController@associateCourse');
            $app->post('{id_course}/disassociate', 'DisciplineController@disassociateCourse');
        });
        $app->get('{id}/courses', 'DisciplineController@getDisciplineCourses');
    });

    $app->group(['middleware' => 'employee', 'prefix' => 'class'], function () use ($app) {
        $app->get('/', 'ClassController@index');
        $app->get('{id}', 'ClassController@getClass');
        $app->post('/', 'ClassController@createClass');
        $app->put('{id}', 'ClassController@updateClass');
        $app->delete('{id}', 'ClassController@deleteClass');
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