@extends('layouts.app')

@section('template_title')
    {{ $lote->name ?? "{{ __('Ver') Lote" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Lote</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('lotes.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Producto Id:</strong>
                            {{ $lote->producto_id }}
                        </div>
                        <div class="form-group">
                            <strong>Proveedor Id:</strong>
                            {{ $lote->proveedor_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Ingreso:</strong>
                            {{ $lote->fecha_ingreso }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Caducidad:</strong>
                            {{ $lote->fecha_caducidad }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $lote->cantidad }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
