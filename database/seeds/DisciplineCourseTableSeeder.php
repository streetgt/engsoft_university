<?php

use App\Course;
use Illuminate\Database\Seeder;

/**
 * Class DisciplineCourseTableSeeder
 */
class DisciplineCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discipline_courses = [
            [9, 1],
            [10, 1],
            [9, 2],
            [9, 3],
            [9, 4],
            [10, 4],
            [9, 5],
            [9, 6],
            [9, 7],
            [9, 8],
            [9, 9],
            [9, 10],
            [9, 11],
            [9, 12],
            [9, 13],
            [9, 14],
            [9, 15],
            [9, 16],
            [9, 17],
            [9, 18],
            [9, 19],
            [9, 20],
            [9, 21],
            [9, 22],
            [9, 23],
            [10, 23],
            [9, 24],
            [9, 25],
            [9, 26],
            [9, 27],
            [9, 28],
            [9, 29],
        ];

        foreach ($discipline_courses as $course) {
            DB::table('discipline_course')->insert([
                'course_id'     => $course[0],
                'discipline_id' => $course[1],
                'created_at'    => Carbon\Carbon::now(),
                'updated_at'    => Carbon\Carbon::now(),
            ]);
        }
    }
}
