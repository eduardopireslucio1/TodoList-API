<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\TodoTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user) {
            $todos = $user->todos()->saveMany(Todo::factory()->count(10)->make());
            $todos->each(function ($todo) {
                $todo->tasks()->saveMany(TodoTask::factory()->count(10)->make());
            });
        });
    }
}
