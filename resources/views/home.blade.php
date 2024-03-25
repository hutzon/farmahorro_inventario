@extends('layouts.app')

@section("css")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo de la Empresa" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="card">
                <table id="tabla_lotes" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Lote</th>
                            <th>Producto</th>
                            <th>Fecha Caducidad</th>
                            <th>Tabletas</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lotes as $lote)
                            <tr>

                                <td>{{ $lote->id }}</td>
                                <td>{{ $lote->producto->nombre }}</td>
                                <td>{{ $lote->fecha_caducidad }}</td>
                                <td>{{ $lote->cantidad }}</td>
                                <td>
                                    @php
                                        $fechaCaducidad = \Carbon\Carbon::parse($lote->fecha_caducidad);
                                    @endphp

                                    @if ($fechaCaducidad < $fechaHoy)
                                        <span class="text-danger">Vencido</span>
                                    @elseif ($fechaCaducidad->diffInDays($fechaHoy) <= 30)
                                        <span class="text-warning">Por Vencer</span>
                                    @else
                                        En Plazo
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

@endsection

@section("js")
    <!-- Primero, jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Luego, Bootstrap JS y DataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

    <!-- Finalmente, tu script personalizado -->
    <script>
        new DataTable('#tabla_lotes');
    </script>
@endsection



