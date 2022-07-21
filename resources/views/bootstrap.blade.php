<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Custom jumbotron</h1>
        <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in
            previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your
            liking.</p>

        @hasAccess('platform.welcome')
        <button class="btn btn-primary btn-lg" type="button">Bienvenido al sistema</button>
        <p class="text-success">Nos alegra mucho tenerte en nuestro sistema</p>
        @else
            <button class="btn btn-danger btn-lg" type="button">No eres bienvenido</button>
            <small class="text-muted">Debes tener el permiso <b>Ver mensaje de bienvenida</b>
                para poder ver un agradable mensaje de bienvenida</small>
            @endhasAccess
    </div>
</div>
