<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('CourseTableSeeder');
        $this->call('DisciplineTableSeeder');
        $this->call('DisciplineCourseTableSeeder');
        $this->call('RoomTableSeeder');
        $this->call('ClasseTableSeeder');
    }
}
