<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;


class PermissionServiceProvider extends ServiceProvider
{
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('Reservaciones')
            ->addPermission('reservations.list', 'Lista de reservaciones')
            ->addPermission('reservations.create', 'Registrar reservas');

        $permissions2 = ItemPermission::group('Parqueaderos')
            ->addPermission('parking_lots.list', 'Lista de parqueaderos')
            ->addPermission('parking_lots.create', 'Registrar parqueadero')
            ->addPermission('parking_lots.update', 'Editar parqueadero')
            ->addPermission('parking_lots.destroy', 'Eliminar parqueadero');

        $dashboard->registerPermissions($permissions);
        $dashboard->registerPermissions($permissions2);

    }
}
