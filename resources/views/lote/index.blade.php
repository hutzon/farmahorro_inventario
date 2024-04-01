@extends('layouts.app')

@section('template_title')
    Lote
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Lote') }}
                            </span>

                            <form action="{{ route('lotes.index') }}" method="GET">
                            <div class="form-row align-items-center">
                                <div class="col my-2 mx-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control me-2" name="search" placeholder="Buscar lotes...">
                                        <input type="date" class="form-control me-2" name="date" placeholder="Fecha...">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
</form>


                             <div class="float-right">
                                <a href="{{ route('lotes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>No. Lote</th>
										<th>Producto</th>
										<th>Proveedor</th>
										<th>Fecha Ingreso</th>
										<th>Fecha Caducidad</th>
										<th>Cantidad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotes as $lote)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $lote->id }}</td>
											<td>{{ $lote->producto->nombre }}</td>
											<td>{{ $lote->proveedore->nombre }}</td>
											<td>{{ $lote->fecha_ingreso }}</td>
											<td>{{ $lote->fecha_caducidad }}</td>
											<td>{{ $lote->cantidad }}</td>

                                            <td class="text-end">
                                                <form action="{{ route('lotes.destroy',$lote->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('lotes.show',$lote->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('lotes.edit',$lote->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $lotes->links() !!}
            </div>
        </div>
    </div>
@endsection
