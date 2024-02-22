@extends('layouts.app')

@section('template_title')
    {{ $movimiento->name ?? "{{ __('Show') Movimiento" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Movimiento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('movimientos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Lote Id:</strong>
                            {{ $movimiento->lote_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $movimiento->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $movimiento->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $movimiento->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $movimiento->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
