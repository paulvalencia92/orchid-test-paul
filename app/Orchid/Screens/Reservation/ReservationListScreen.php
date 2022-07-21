<?php

namespace App\Orchid\Screens\Reservation;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Orchid\Filters\Reservation\ReservationUsersFilter;
use App\Orchid\Layouts\AmountListener;
use App\Orchid\Layouts\Reservation\ReservationFiltersLayout;
use App\Orchid\Layouts\Reservation\ReservationListLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ReservationListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'reservations' => Reservation::query()
                ->orderByDesc('from')
                ->filters()
                ->filtersApplySelection(ReservationFiltersLayout::class)
                ->with('parking_lot', 'user')
                ->paginate(10),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Reservaciones';
    }


    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Listado de las reservaciones';
    }


    /**
     * @return iterable|null
     *  Ejemplo de permisos
     */
    public function permission(): ?iterable
    {
        return [
            'reservations.list',
        ];
    }


    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Registrar Parqueadero'))
                ->icon('plus')
                ->route('parking_lots.create')
                ->canSee(auth()->user()->hasAccess('parking_lots.create')),
            ModalToggle::make('Registrar reserva')
                ->modal('FormReservationModal')
                ->method('save')
                ->icon('plus')
                ->canSee(auth()->user()->hasAccess('reservations.create')),
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
            ReservationFiltersLayout::class,
            ReservationListLayout::class,
            Layout::modal('FormReservationModal', AmountListener::class)
                ->title('Formulario de reservaciones')
                ->applyButton('Guardar')
                ->closeButton('Cancelar')
        ];
    }


    public function save(Reservation $reservation, ReservationRequest $request): void
    {
        $reservation->fill($request->collect('reservation')->toArray());
        $reservation->attachment()->syncWithoutDetaching(
            $request->input('parking.attachment', [])
        );
        $reservation->save();
        Toast::info(__('Reserva guardada correctamente.'));
    }


    public function remove(Request $request)
    {
        $reservation = Reservation::findOrFail($request->get('id'));
        if ($reservation->picture()) {
            $picture = $reservation->picture()->first();
            Storage::delete("public/{$picture->path}{$picture->name}.{$picture->extension}");
            $reservation->picture()->delete();
        }

        $reservation->delete();
        Toast::info(__('reservacion eliminada correctamente'));
    }


    public function asyncDays($days = '')
    {
        return [
            'days' => $days
        ];
    }

}
