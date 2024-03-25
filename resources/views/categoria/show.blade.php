@extends('layouts.app')

@section('template_title')
    {{ $categoria->name ?? "{{ __('Ver') Categoria" }}
@endsection

@section('content')
    <section class="content container-fluid ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Categoria</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('categorias.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $categoria->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
