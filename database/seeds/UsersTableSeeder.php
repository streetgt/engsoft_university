<?php

use App\Student;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 100)->create()->each(function ($u) {
            $u->roles()->save(factory(App\Role::class)->make());
        });
    }
}
