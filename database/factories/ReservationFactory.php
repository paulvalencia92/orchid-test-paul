<?php

namespace Database\Factories;

use App\Models\ParkingLot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'picture' => 'https://via.placeholder.com/512x512.png/2A4365?text=Sin%20Imagen',
            'from' => Carbon::now()->addDay(rand(0,6)),
            'user_id' => User::all()->random(1)->pluck('id')->first(),
            'parking_lot_id' => ParkingLot::all()->random(1)->pluck('id')->first()
        ];
    }
}
