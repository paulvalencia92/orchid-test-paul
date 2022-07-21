<?php

use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tests', function () {

    $reservations = Reservation::query()->orderBy('from')->get();
    $data = $reservations->groupBy('from')
        ->map(function ($data, $from) {
            $date = Carbon::parse($from);
            $dateEs = sprintf('%s de %s de %s', $date->day, $date->monthName, $date->year);
            return [
                'name' => $dateEs,
                'values' => [count($data)],
                'labels' => [count($data)],
            ];
        })->values();


    $values = collect();
    $labels = collect();

    foreach ($data as $i) {
        $values->push($i['values']);
        $labels->push($i['name']);
    }

    return [
        [
            'name' => 'Graficos',
            'values' => $values->toArray(),
            'labels' => $labels->toArray()
        ]
    ];


});

Route::get('/', function () {
    return redirect('admin');
});
