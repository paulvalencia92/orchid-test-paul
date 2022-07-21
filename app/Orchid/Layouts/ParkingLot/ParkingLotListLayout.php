<?php

namespace App\Orchid\Layouts\ParkingLot;

use App\Models\ParkingLot;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ParkingLotListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'parking_lots';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Nombre')),
            TD::make('address', __('Dirección')),
            TD::make(__('Actions'))
                ->render(function (ParkingLot $parkingLot) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Editar')
                                ->icon('pencil')
                                ->modal('FormParkingLotModal')
                                ->method('update')
                                ->asyncParameters([
                                    'parking' => $parkingLot->id,
                                ])->canSee(auth()->user()->hasAccess('parking_lots.update')),
                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Una vez que se elimine la información, todos sus recursos y datos se eliminarán de forma permanente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.'))
                                ->method('remove', [
                                    'id' => $parkingLot->id,
                                ])->canSee(auth()->user()->hasAccess('parking_lots.destroy')),

                        ])->canSee(auth()->user()->hasAnyAccess(['parking_lots.update', 'parking_lots.destroy']));
                })
        ];
    }
}
