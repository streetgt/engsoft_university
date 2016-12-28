<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->smallInteger('ects')->nullable()->default(null);
            $table->string('description', 128)->nullable()->default(null);

            $table->timestamps();

        });

        Schema::create('student', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->nullable()->default(null);
            $table->string('surname', 20)->nullable()->default(null);
            $table->string('email');
            $table->string('ssn', 20)->nullable()->default(null);
            $table->date('birthdate')->nullable()->default(null);
            $table->enum('gender', ['F',  'M']);
            $table->string('token');

            $table->timestamps();

        });

        Schema::create('discipline', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->nullable();
            $table->smallInteger('ects')->nullable();

            $table->timestamps();

        });

        Schema::create('instructor', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->nullable()->default(null);
            $table->string('surname', 20)->nullable()->default(null);
            $table->string('email', 254)->nullable()->default(null);
            $table->date('hiredate')->nullable()->default(null);
            $table->string('vatnumber', 60)->nullable()->default(null);
            $table->enum('gender', ['F',  'M']);

            $table->timestamps();

        });

        Schema::create('grade', function(Blueprint $table) {
            $table->integer('student_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('discipline_id')->unsigned();
            $table->integer('instructor_id')->unsigned();
            $table->boolean('grade')->nullable()->default(null);
            $table->string('description');
            $table->date('date')->nullable()->default(null);

            $table->index('student_id','grade_student_id_fk_idx');
            $table->index('course_id','grade_course_id_fk_idx');
            $table->index('discipline_id','grade_discipline_id_fk_idx');
            $table->index('instructor_id','grade_instructor_id_fk_idx');

            $table->foreign('student_id')
                ->references('id')->on('student');

            $table->foreign('course_id')
                ->references('id')->on('course');

            $table->foreign('discipline_id')
                ->references('id')->on('discipline');

            $table->foreign('instructor_id')
                ->references('id')->on('instructor');

            $table->timestamps();

        });

        Schema::create('room', function(Blueprint $table) {
            $table->increments('id');
            $table->string('number', 10)->nullable()->default(null);
            $table->integer('capacity')->nullable()->default(null);

            $table->timestamps();

        });

        Schema::create('classe', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('discipline_id')->unsigned();
            $table->integer('instructor_id')->unsigned();
            $table->string('name', 10)->nullable()->default(null);

            $table->index('discipline_id','classe_discipline_id_fk_idx');
            $table->index('instructor_id','classe_instructor_id_fk_idx');

            $table->foreign('discipline_id')
                ->references('id')->on('discipline');

            $table->foreign('instructor_id')
                ->references('id')->on('instructor');

            $table->timestamps();

        });

        Schema::create('schedule', function(Blueprint $table) {
            $table->integer('room_id')->unsigned();
            $table->integer('classe_id')->unsigned();
            $table->integer('day')->nullable()->default(null);
            $table->string('start_hour', 10)->nullable()->default(null);
            $table->boolean('duration')->nullable()->default(null);

            $table->index('room_id','schedule_room_id_fk_idx');
            $table->index('classe_id','schedule_classe_id_fk_idx');

            $table->foreign('room_id')
                ->references('id')->on('room');

            $table->foreign('classe_id')
                ->references('id')->on('classe');

            $table->timestamps();

        });

        Schema::create('signs', function(Blueprint $table) {
            $table->integer('student_id')->unsigned();
            $table->integer('discipline_id')->unsigned();
            $table->integer('classe_id')->unsigned();

            $table->index('student_id','signs_student_id_idx');
            $table->index('discipline_id','signs_disicipline_id_fk_idx');
            $table->index('classe_id','signs_classe_id_fk_idx');

            $table->foreign('student_id')
                ->references('id')->on('student');

            $table->foreign('discipline_id')
                ->references('id')->on('discipline');

            $table->foreign('classe_id')
                ->references('id')->on('classe');

            $table->timestamps();

        });
        
        Schema::create('student_course', function(Blueprint $table) {
            $table->integer('student_id')->unsigned();
            $table->integer('course_id')->unsigned();

            $table->index('course_id','student_course_course_id_idx');
            $table->index('student_id','student_course_student_id_fk_idx');

            $table->foreign('course_id')
                ->references('id')->on('course');

            $table->foreign('student_id')
                ->references('id')->on('student');

            $table->timestamps();

        });

        Schema::create('discipline_course', function(Blueprint $table) {
            $table->integer('course_id')->unsigned();
            $table->integer('discipline_id')->unsigned();

            $table->index('course_id','discipline_course_course_id_idx');
            $table->index('discipline_id','discipline_course_discipline_id_idx');

            $table->foreign('course_id')
                ->references('id')->on('course');

            $table->foreign('discipline_id')
                ->references('id')->on('discipline');

            $table->timestamps();

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course');
        Schema::drop('student');
        Schema::drop('discipline');
        Schema::drop('instructor');
        Schema::drop('grade');
        Schema::drop('room');
        Schema::drop('classe');
        Schema::drop('schedule');
        Schema::drop('signs');
        Schema::drop('student_course');
        Schema::drop('discipline_course');

    }
}