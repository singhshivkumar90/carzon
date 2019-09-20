<?php

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds of tickets table.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Ticket::class, 10)->create();
    }
}
