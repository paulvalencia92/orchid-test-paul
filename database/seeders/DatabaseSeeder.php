<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ParkingLot;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('orchid:admin admin admin@admin.com password');
        $this->createParkingLots();
        User::factory(40)->create();
        Reservation::factory(40)->create();

    }


    protected function createParkingLots()
    {
        ParkingLot::create([
            'name' => 'Parqueadero 1',
            'address' => 'Calle falsa 1234'
        ]);

        ParkingLot::create([
            'name' => 'Parqueadero 2',
            'address' => 'Calle falsa 1234'
        ]);

        ParkingLot::create([
            'name' => 'Parqueadero 3',
            'address' => 'Calle falsa 1234'
        ]);

        ParkingLot::create([
            'name' => 'Parqueadero 4',
            'address' => 'Calle falsa 1234'
        ]);
        ParkingLot::create([
            'name' => 'Parqueadero 5',
            'address' => 'Calle falsa 1234'
        ]);
    }
}
