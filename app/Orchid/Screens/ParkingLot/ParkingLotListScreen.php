<?php

namespace App\Orchid\Screens\ParkingLot;

use App\Models\ParkingLot;
use App\Orchid\Layouts\AmountListener;
use App\Orchid\Layouts\ParkingLot\ParkingLotFormLayout;
use App\Orchid\Layouts\ParkingLot\ParkingLotListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ParkingLotListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'parking_lots' => ParkingLot::query()
                ->filters()
                ->get()

        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Lista de parqueaderos';
    }


    public function permission(): ?iterable
    {
        return [
            'parking_lots.list',
        ];
    }


    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ParkingLotListLayout::class,
            Layout::modal('FormParkingLotModal', ParkingLotFormLayout::class)
                ->title('Formulario de parqueaderos')
                ->applyButton('Guardar')
                ->closeButton('Cancelar')
                ->async('asyncGetParkingLot')
        ];
    }


    public function asyncGetParkingLot(ParkingLot $parking): iterable
    {
        return [
            'parking' => $parking,
        ];
    }

    public function update(ParkingLot $parking, Request $request): void
    {
        $parking->fill($request->collect('parking')->toArray())->save();
        $parking->attachment()->syncWithoutDetaching(
            $request->input('parking.attachment', [])
        );
        Toast::info(__('Parqueadero actualizado correctamente'));
    }


    public function remove(Request $request)
    {
        $parking = ParkingLot::findOrFail($request->get('id'));
        $parking->attachment->each->delete();
        $parking->delete();
        Toast::info(__('Parqueadero was removed'));
    }
}
