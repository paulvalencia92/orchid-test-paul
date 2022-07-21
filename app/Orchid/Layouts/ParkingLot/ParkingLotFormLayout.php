<?php

namespace App\Orchid\Layouts\ParkingLot;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class ParkingLotFormLayout extends Rows
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
            Input::make('parking.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Nombre'))
                ->placeholder(__('Nombre del parqueadero')),
            Input::make('parking.address')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Dirección'))
                ->placeholder(__('Dirección del parqueadero')),
            Upload::make('parking.attachment')
                ->title('Imagenes del parqueadero')
                ->groups('photos')
                ->acceptedFiles('image/*')
        ];
    }
}
