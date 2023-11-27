<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0062b0aa7f.js" crossorigin="anonymous"></script>

    <title>Crud en laravel</title>
</head>

<body class="d-flex flex-column align-items-center">
    <h1>CRUD CON ITEMS</h1>
    @if (session('alert'))
        <div class="alert alert-{{ session('alert')[1] }} w-75">{{ session('alert')[0] }}</div>
    @endif

    <div class="w-75 p-4 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="bg-info-subtle text-center">ID</th>
                    <th class="bg-info-subtle text-center">Descripción</th>
                    <th class="bg-info-subtle text-center">Fecha</th>
                    <th class="bg-info-subtle text-center">Opciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos as $item)
                    <tr>
                        <th>{{ $item->id_item }}</th>
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->fecha }}</td>
                        {{-- opciones --}}
                        <td class="d-flex justify-content-around">
                            <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $item->id_item }}">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmar{{ $item->id_item }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>

                        <!-- Modal de modificar datos-->
                        <div class="modal fade" id="modalEditar{{ $item->id_item }}" tabindex="-1"
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
                                                <label for="inputCodigo" class="form-label">ID</label>
                                                <input type="number" min="1" class="form-control text-bg-secondary"
                                                    id="inputCodigo" value="{{ $item->id_item }}" name="txtid"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputNombre" class="form-label">Descripción</label>
                                                <input type="text" class="form-control" id="inputNombre"
                                                    value="{{ $item->descripcion }}" name="txtdescripcion">
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPrecio" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" id="inputPrecio" value="{{ $item->fecha }}"
                                                    name="txtfecha">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- alerta de confirmación --}}
                        <div>
                            <!-- Modal de eliminación -->
                            <div class="modal fade" id="modalConfirmar{{ $item->id_item }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">⁉️</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Eliminar el item con ID: {{$item->id_item}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar
                                            </button>
                                            <a href="{{ route('crud.delete', $item->id_item) }}" class="btn btn-danger">Confirmar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Botón de registro --}}
        <button class="btn btn-info m-4" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            <i class="fa-solid fa-plus"></i> Agregar
        </button>

        {{-- modal Agregar producto --}}
        <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('crud.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="inputDescripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="inputDescripcion" name="txtdescripcion">
                            </div>
                            <div class="mb-3">
                                <label for="inputFecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="inputFecha" name="txtfecha">
                            </div>
                            <div class="modal-footer">
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
