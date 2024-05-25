@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Movimiento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="d-flex justify-content-center">
            <div class="col-md-10">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Movimiento</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('movimientos.update', $movimiento->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('movimiento.form', ['productoNombre' => $productoNombre])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    function fetchProductName() {
        var loteId = document.getElementById('lote_id').value;

        fetch(`/api/get-product-name/${loteId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('producto').value = data.producto;
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
@endsection
