@extends('layouts.app')

@section('template_title')
    {{ $producto->name ?? "{{ __('Ver') Producto" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> {{ __('Regresar) }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Principio Activo:</strong>
                            {{ $producto->principio_activo }}
                        </div>
                        <div class="form-group">
                            <strong>Categoria Id:</strong>
                            {{ $producto->categoria_id }}
                        </div>
                        <div class="form-group">
                            <strong>Presentacion:</strong>
                            {{ $producto->presentacion }}
                        </div>
                        <div class="form-group">
                            <strong>Miligramos:</strong>
                            {{ $producto->miligramos }}
                        </div>
                        <div class="form-group">
                            <strong>Stock:</strong>
                            {{ $producto->stock }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
