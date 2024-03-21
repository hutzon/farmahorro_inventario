@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
                        </p>
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo de la Empresa" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <table id="tabla_lotes" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Proveedor</th>
                            <th>Fecha Ingreso</th>
                            <th>Fecha Caducidad</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lotes as $lote)
                            <tr>

                                <td>{{ $lote->producto->nombre }}</td>
                                <td>{{ $lote->proveedore->nombre }}</td>
                                <td>{{ $lote->fecha_ingreso }}</td>
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



