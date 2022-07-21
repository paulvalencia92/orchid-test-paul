<?php

namespace App\Orchid\Layouts\Reservation;

use App\Models\Reservation;
use App\Orchid\Filters\ReservationUsersFilter;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;

class ReservationListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'reservations';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('picture', __('Imagen'))
                ->width('150')
                ->render(function (Reservation $reservation) {
                    return "<img src='{$reservation->my_picture}'
                              alt='sample'
                              class='mw-100 d-block img-fluid'>";
                }),
            TD::make('user.name', __('Reservado por')),
            TD::make('parking_lot.name', __('Parqueadero')),
            TD::make('from', __('Fecha de la reserva'))
                ->filter(Input::make()->type('date')),
            TD::make('to', __('Hasta'))
                ->filter(Input::make()->type('date')),
            TD::make(__('Acciones'))
                ->render(function (Reservation $reservation) {
                    return Button::make(__('Cancelar reserva'))
                        ->icon('trash')
                        ->confirm(__('Una vez que se elimine la información, todos sus recursos y datos se eliminarán de forma permanente.'))
                        ->method('remove', [
                            'id' => $reservation->id,
                        ]);
                }),
        ];
    }
}
