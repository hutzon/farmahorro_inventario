@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Movimiento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Movimiento</span>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('movimientos.vender') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('movimiento.form')

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
