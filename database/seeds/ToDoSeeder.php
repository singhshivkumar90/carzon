<?php

use Illuminate\Database\Seeder;

class ToDoSeeder extends Seeder
{
    /**
     * Run the database seeds of to-do table.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\ToDo::class, 10)->create();
    }
}
