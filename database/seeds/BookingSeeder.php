<?php

use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds of bookings table.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Booking::class, 50)->create();
    }
}
