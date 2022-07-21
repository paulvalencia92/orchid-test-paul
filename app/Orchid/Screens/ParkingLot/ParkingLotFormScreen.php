<?php

namespace App\Orchid\Screens\ParkingLot;

use App\Models\ParkingLot;
use App\Orchid\Layouts\ParkingLot\ParkingLotFormLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ParkingLotFormScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Formulario de parqueaderos';
    }


    public function description(): ?string
    {
        return 'Por medio de este formulario puedes registrar los parqueaderos';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(ParkingLotFormLayout::class)
                ->title('Información del parqueadero'),
        ];
    }


    public function save(ParkingLot $parkingLot, Request $request)
    {
        $parkingLot->fill($request->get('parking'))->save();
        $parkingLot->attachment()->syncWithoutDetaching(
            $request->input('parking.attachment', [])
        );
        Toast::info(__('Parqueadero registrado correctamente'));
        return redirect()->route('reservations.list');
    }
}
