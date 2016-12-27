<?php

use App\Course;
use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            ['Análises Clínicas e Saúde Pública', 210, null],
            ['Ciências da Nutrição', 240, null],
            ['Ciências Farmacêuticas', 300, null],
            ['Enfermagem', 240, null],
            ['Fisioterapia', 210, null],
            ['Medicina Dentária', 300, null],
            ['Terapêutica da Fala', 210, null],
            ['Arquitectura e Urbanismo', 300, null],
            ['Engenharia Informática', 180, null],
            ['Engenharia Civil', 180, null],
            ['Gestão da Qualidade, Ambiente e Segurança', 180, null],
            ['Ciência Política e Relações Internacionais', 180, null],
            ['Ciências da Comunicação', 180, null],
            ['Ciências Empresariais', 180, null],
            ['Criminologia', 180, null],
            ['Gestão Comercial e Contabilidade', 180, null],
            ['Psicologia', 180, null]
        ];

        foreach ($courses as $course) {
            Course::create([
                'name'        => $course[0],
                'ects'        => $course[1],
                'description' => $course[2],
            ]);
        }
    }
}
