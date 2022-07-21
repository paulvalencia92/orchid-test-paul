<?php

namespace App\Orchid\Layouts\Reservation;

use App\Models\ParkingLot;
use App\Orchid\Layouts\AmountListener;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class ReservationFormLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Select::make('reservation.parking_lot_id')
                ->fromModel(ParkingLot::class, 'name')
                ->title(__('Parqueadero'))
                ->empty('No select')
                ->required(),
            CheckBox::make('days')
                ->title('Reservar mas dias'),
            Input::make('reservation.from')
                ->type('date')
                ->max(255)
                ->required()
                ->title($this->query->get('days') == 'on' ? 'Desde' : 'Fecha reserva')
                ->placeholder(__('Fecha inicio')),
            Input::make('reservation.to')
                ->type('date')
                ->max(255)
                ->title(__('Hasta'))
                ->placeholder(__('Fecha fin'))
                ->canSee($this->query->get('days') == 'on'),
            Picture::make('reservation.picture')
                ->title('Imagen de la reserva')
                ->required()
                ->targetId()
        ];
    }
}
