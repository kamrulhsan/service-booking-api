<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Booking::truncate();
        Schema::enableForeignKeyConstraints();

        $customers = User::where('is_admin', false)->get();
        $services = Service::where('status', true)->get();

        if ($customers->count() > 0 && $services->count() > 0) {
            // Create some sample bookings
            for ($i = 0; $i < 10; $i++) {
                Booking::create([
                    'user_id' => $customers->random()->id,
                    'service_id' => $services->random()->id,
                    'booking_date' => Carbon::now()->addDays(rand(1, 30))->addHours(rand(9, 17)),
                    'status' => collect(['pending', 'confirmed', 'cancelled'])->random()
                ]);
            }
        }
    }
}
