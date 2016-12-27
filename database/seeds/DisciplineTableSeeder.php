<?php

use App\Discipline;
use Illuminate\Database\Seeder;

class DisciplineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disciplines = [
            ['Matemática I', 7],
            ['Linguagens de Programação I', 7],
            ['Redes de Computadores I', 7],
            ['Física', 7],
            ['Sistemas Digitais', 6],
            ['Multimédia I', 6],
            ['Introdução à Algoritmia e Programação', 6],
            ['Arquitectura de Computadores', 6],
            ['Bases de Dados', 6],
            ['Sistemas de Informação', 4],
            ['Algoritmos e Estruturas de Dados I', 6],
            ['Engenharia de Software', 6],
            ['Gramática da comunicação', 3],
            ['Análise Numérica', 5],
            ['Laboratório de Programação', 5],
            ['Inglês', 3],
            ['Estatística Aplicada', 7],
            ['Linguagens de Programação II', 7],
            ['Sistemas Distribuídos', 8],
            ['Electrónica Aplicada', 7],
            ['Sistemas Operativos', 7],
            ['Redes de Computadores II', 7],
            ['Matemática II', 7],
            ['Algoritmos e Estruturas de Dados II', 6],
            ['Laboratório de Projeto Integrado', 7],
            ['Análise de Sistemas', 6],
            ['Hardware e Sensores', 6],
            ['Multimédia II', 6],
            ['Investigação Operacional', 4],
        ];

        foreach ($disciplines as $discipline) {
            Discipline::create([
                'name' => $discipline[0],
                'ects' => $discipline[1],
            ]);
        }
    }
}
