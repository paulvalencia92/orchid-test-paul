<?php

namespace App\Orchid\Layouts;


use App\Orchid\Layouts\Reservation\ReservationFormLayout;
use Orchid\Screen\Layouts\Listener;
use Orchid\Support\Facades\Layout;

class AmountListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'days',
    ];


    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = 'asyncDays';

    /**
     * @return Layout[]
     */
    protected function layouts(): iterable
    {
        return [
            ReservationFormLayout::class
        ];
    }
}
