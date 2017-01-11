URL: /test

`GET`
`App\Http\Controllers\StudentController@test`

URL: /api/user

`GET`
`App\Http\Controllers\UserController@index`

URL: /api/user/{id}

`GET`
`App\Http\Controllers\UserController@getUser`

Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/user

`POST`
`App\Http\Controllers\UserController@createUser`

Parametros | Informação
-------- | ---
name | requirido, string
surname | requirido, string
ssn | requirido, string
birthdate | requirido, date
gender | requirido, F ou M
role | requirido, 0-2

URL: /api/user/{id}

`PUT`
`App\Http\Controllers\UserController@updateUser`

Parametros | Informação
-------- | ---
name | string
surname | string
ssn | string
birthdate | date
gender | enum, F ou M
role | integer, 0-2

URL: /api/user/{id}

`DELETE`
`App\Http\Controllers\UserController@deleteUser`

Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/student

`GET`
`App\Http\Controllers\StudentController@index`

URL: /api/student/{id}

`GET`
`App\Http\Controllers\StudentController@getStudent`

Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/student

`POST`
`App\Http\Controllers\StudentController@createStudent`

Parametros | Informação
-------- | ---
name | string
surname | string
ssn | string
birthdate | date
gender | enum, F ou M

URL: /api/student/{id}

`PUT`
`App\Http\Controllers\UserController@updateUser`

Parametros | Informação
-------- | ---
name | string
surname | string
ssn | string
birthdate | date
gender | enum, F ou M

URL: /api/student/{id}

`DELETE`
`App\Http\Controllers\StudentController@deleteStudent`

Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/student/{id}/grade

`GET`
`App\Http\Controllers\StudentController@getGrades`

Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/student/{id}/schedule

`GET`
`App\Http\Controllers\ScheduleController@getUserSchedule`
token,student
Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/student/{id}/course

`GET`
`App\Http\Controllers\StudentController@getCourses`
token,student

Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/student/{id}/course/enroll

`POST`
`App\Http\Controllers\StudentController@enrollCourse`

Parametros | Informação
-------- | ---
id | requerido, integer
course_id | requerido, integer ($_GET)

URL: /api/student/{id}/class

`GET`
`App\Http\Controllers\StudentController@getClasses`

Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/student/{id}/class/enroll

`POST`
`App\Http\Controllers\StudentController@enrollClass`

Parametros | Informação
-------- | ---
id | requerido, integer
course_id | requerido, integer ($_GET)

URL: /api/course

`GET`
`App\Http\Controllers\CourseController@index`

URL: /api/course/{id}

`GET`
`App\Http\Controllers\CourseController@getCourse`

Parametros | Informação
-------- | ---
id | requerido, integer

URL: /api/course

`POST`
`App\Http\Controllers\CourseController@createCourse`
token,employee

Parametros | Informação
-------- | ---
{id} | requerido, integer
name | string
ects | integer
description | string

URL: /api/course/{id}

`PUT`
`App\Http\Controllers\CourseController@updateCourse`

Parametros | Informação
-------- | ---
{id} | requerido, integer
name | string
ects | integer
description | string

URL: /api/course/{id}

`DELETE`
`App\Http\Controllers\CourseController@deleteCourse`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/course/{id}/disciplines

`GET`
`App\Http\Controllers\CourseController@getCourseDisciplines`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/discipline

`GET`
`App\Http\Controllers\DisciplineController@index`

URL: /api/discipline/{id}

`GET`
`App\Http\Controllers\DisciplineController@getDiscipline`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/discipline

`POST`
`App\Http\Controllers\DisciplineController@createDiscipline`

Parametros | Informação
-------- | ---
name | string
ects | integer
course_id | requerido, integer

URL: /api/discipline/{id}

`PUT`
`App\Http\Controllers\DisciplineController@updateDiscipline`

Parametros | Informação
-------- | ---
{id} | requerido, integer
name | string
ects | integer
course_id | integer

URL: /api/discipline/{id}

`DELETE`
`App\Http\Controllers\DisciplineController@deleteDiscipline`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/discipline/{id_discipline}/course/{id_course}/associate

`POST`
`App\Http\Controllers\DisciplineController@associateCourse`

Parametros | Informação
-------- | ---
{id_discipline} | requerido, integer
{id_course} | requerido, integer

URL: /api/discipline/{id_discipline}/course/{id_course}/disassociate

`POST`
`App\Http\Controllers\DisciplineController@disassociateCourse`

Parametros | Informação
-------- | ---
{id_discipline} | requerido, integer
{id_course} | requerido, integer

URL: /api/discipline/{id}/courses

`GET`
`App\Http\Controllers\DisciplineController@getDisciplineCourses`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/class

`GET`
`App\Http\Controllers\ClassController@index`

URL: /api/class/{id}

`GET`
`App\Http\Controllers\ClassController@getClass`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/class

`POST`
`App\Http\Controllers\ClassController@createClass`

Parametros | Informação
-------- | ---
name | string
discipline_id | requerido, integer
instructor_id | requerido, integer

URL: /api/class/{id}

`PUT`
`App\Http\Controllers\ClassController@updateClass`

Parametros | Informação
-------- | ---
{id} | requerido, integer
name | string
discipline_id | integer
instructor_id | integer

URL: /api/class/{id}

`DELETE`
`App\Http\Controllers\ClassController@deleteClass`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/room

`GET`
`App\Http\Controllers\RoomController@index`

URL: /api/room/free

`GET`
`App\Http\Controllers\RoomController@getRoomsFree`

URL: /api/room/{id}

`GET`
`App\Http\Controllers\RoomController@getRoom`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/room

`POST`
`App\Http\Controllers\RoomController@createRoom`

Parametros | Informação
-------- | ---
number | string
capacity | integer

URL: /api/room/{id}

`PUT`
`App\Http\Controllers\RoomController@updateRoom`

Parametros | Informação
-------- | ---
{id} | requerido, integer
number | string
capacity | integer

URL: /api/room/{id}

`DELETE`
`App\Http\Controllers\RoomController@deleteRoom`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/room/{id}/occupied
`GET`
`App\Http\Controllers\RoomController@getRoomOccupiedInformation`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/grade

`GET`
`App\Http\Controllers\GradeController@index`

URL: /api/instructor/grade

`POST`
`App\Http\Controllers\GradeController@createGrade`

Parametros | Informação
-------- | ---
student_id | requerido, integer
discipline_id | requerido, integer
instructor_id | requerido, integer
description | string
grade | integer

URL: /api/grade/{id}

`GET`
`App\Http\Controllers\GradeController@getGrade`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/grade

`POST`
`App\Http\Controllers\GradeController@createGrade`

Parametros | Informação
-------- | ---
student_id | requerido, integer
discipline_id | requerido, integer
instructor_id | requerido, integer
description | string
grade | integer

URL: /api/grade/{id}

`PUT`
`App\Http\Controllers\GradeController@updateGrade`

Parametros | Informação
-------- | ---
{id} | requerido, integer
student_id | integer
discipline_id | integer
instructor_id | integer
description | string
grade | integer

URL: /api/grade/{id}

`DELETE`
`App\Http\Controllers\GradeController@deleteGrade`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/schedule

`GET`
`App\Http\Controllers\ScheduleController@index`

URL: /api/schedule/{id}

`GET`
`App\Http\Controllers\ScheduleController@getSchedule`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/schedule

`POST`
`App\Http\Controllers\ScheduleController@createSchedule`

Parametros | Informação
-------- | ---
room_id | requerido, integer
class_id | requerido, integer
day | integer
start_hour | integer
duration | integer

URL: /api/schedule/{id}

`PUT`
`App\Http\Controllers\ScheduleController@updateSchedule`

Parametros | Informação
-------- | ---
{id} | requerido, integer
room_id | integer
class_id | integer
day | integer
start_hour | integer
duration | integer

URL: /api/schedule/{id}

`DELETE`
`App\Http\Controllers\ScheduleController@deleteSchedule`

Parametros | Informação
-------- | ---
{id} | requerido, integer

URL: /api/schedule/{id}/user

`GET`
`App\Http\Controllers\ScheduleController@getUserSchedule`

Parametros | Informação
-------- | ---
{id} | requerido, integer
