<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0062b0aa7f.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>
    <h1 class="text-center p-3">Hello :3</h1>
    @if (session('correcto'))
        <div class="alert alert-success">{{ session('correcto') }}</div>
    @endif

    @if (session('incorrecto'))
        <div class="alert alert-danger">{{ session('incorrecto') }}</div>
    @endif

    <script>
        function confirmar() {
            return confirm("¿Estás seguro de que quieres eliminar?");
        }
    </script>
    <div class="p-4 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>id_producto</th>
                    <th>nombre</th>
                    <th>precio</th>
                    <th>cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos as $item)
                    <tr>
                        <th>{{ $item->id_producto }}</th>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->precio }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>
                            <a href="" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $item->id_producto }}">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="{{ route('crud.delete', $item->id_producto) }}" onclick="confirmar()"
                                class="btn btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>

                        <!-- Modal de modifical datos-->
                        <div class="modal fade" id="modalEditar{{ $item->id_producto }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar datos</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('crud.update') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="inputCodigo" class="form-label">Código</label>
                                                <input type="number" min="1" class="form-control"
                                                    id="inputCodigo" value="{{ $item->id_producto }}" name="txtcodigo"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputNombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="inputNombre"
                                                    value="{{ $item->nombre }}" name="txtnombre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPrecio" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="inputPrecio"
                                                    min="0" step="0.1" value="{{ $item->precio }}"
                                                    name="txtprecio">
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputCantidad" class="form-label">Cantidad</label>
                                                <input type="number" min="0" class="form-control"
                                                    id="inputCantidad" value="{{ $item->cantidad }}"
                                                    name="txtcantidad">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar
                                                </button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- alerta de confirmación --}}
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Launch demo modal
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-warning m-4" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            <i class="fa-solid fa-plus"></i> Agregar
        </button>

        {{-- modal Agregar producto --}}
        <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('crud.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="inputCodigo" class="form-label">Código</label>
                                <input type="number" min="1" class="form-control" id="inputCodigo"
                                    name="txtcodigo">
                            </div>
                            <div class="mb-3">
                                <label for="inputNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="inputNombre" name="txtnombre">
                            </div>
                            <div class="mb-3">
                                <label for="inputPrecio" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="inputPrecio" min="0"
                                    step="0.1" name="txtprecio">
                            </div>
                            <div class="mb-3">
                                <label for="inputCantidad" class="form-label">Cantidad</label>
                                <input type="number" min="0" class="form-control" id="inputCantidad"
                                    name="txtcantidad">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
