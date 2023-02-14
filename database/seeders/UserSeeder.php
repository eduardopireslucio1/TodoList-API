<?php

namespace Database\Seeders;

use Carbon\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Eduardo',
            'last_name' => 'Pires Lucio',
            'email' => 'eduardopireslucioo@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::factory()
        ->count(5)
        ->create();
    }
}
