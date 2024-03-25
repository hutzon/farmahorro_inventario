@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Proveedore
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Proveedore</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('proveedores.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('proveedore.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
