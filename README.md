## Screens

- Explicar en pocas palabras como funciona el mecanismo de Screens de Laravel Orchid
  - Cuando generamos un screen se genera un archivo el cual renderizara una vista, podemos vincular este archivo a una ruta `routes/platform.php`, dentro de esta archivo podemos hacer multiples cosas y vincular muchos de los componentes que nos ofrece orchid.
## Form elements

- ¿Que *Form element* deberia usar para cargar archivos?
  - `Picture::make` para un solo archivo y `Upload::make` para varios archivos
- ¿Que *Form element* deberia usar para crear una tabla con con campos modificables?
  - Primero debemos generar con el comando `php artisan orchid:table NameListLayout` el cual nos generara un archivo, la clase dentro de este archivo extiende de una clase abstracta `Table` por lo que dentro de ella podemos crear campos en el  metodo columns
- ¿Con cuales *Form elements* puedo crear un selector con relaciones?
  - `Relation::make('idea')
    ->fromModel(Idea::class, 'name')
    ->title('Choose your idea');`

## Permissions
- Agregar un ejemplo de como serian las validaciones de permisos desde Screens (Aplicarlo)
- Agregar un ejemplo de como serian las validaciones de permisos desde un Middleware (Solo explicarlo mas no intergrarlo de forma que genere conflictos)
- Agregar un ejemplo de como serian las validaciones de permisos desde un Blade (Solo explicarlo mas no integrarlo de forma que genere conflictos)
