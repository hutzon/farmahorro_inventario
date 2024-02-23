@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">

                     <div>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
                        </p>
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo de la Empresa">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
