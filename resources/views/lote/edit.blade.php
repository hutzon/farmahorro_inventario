@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Lote
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="d-flex justify-content-center">
            <div class="col-md-10">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Lote</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('lotes.update', $lote->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('lote.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
