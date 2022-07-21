<?php

namespace App\Orchid\Layouts\Reservation;


use App\Orchid\Filters\Reservation\ReservationParkingFilter;
use App\Orchid\Filters\Reservation\ReservationUsersFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class ReservationFiltersLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): iterable
    {
        return [
            ReservationUsersFilter::class,
            ReservationParkingFilter::class
        ];
    }
}
