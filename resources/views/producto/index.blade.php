@extends('layouts.app')

@section('template_title')
    Producto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Producto') }}
                            </span>

                            <form action="{{ route('productos.index') }}" method="GET">
                                <div class="form-row align-items-center">
                                    <div class="col my-2 mx-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Buscar productos...">
                                            <div class="ms-2 input-group-append">
                                                <button type="submit" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

										<th>Nombre</th>
										<th>Principio Activo</th>
										<th>Categoria</th>
										<th>Presentacion</th>
										<th>Miligramos</th>
										<th>Stock</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $producto->nombre }}</td>
											<td>{{ $producto->principio_activo }}</td>
											<td>{{ $producto->categoria->nombre }}</td>
											<td>{{ $producto->presentacion }}</td>
											<td>{{ $producto->miligramos }}</td>
											<td>{{ $producto->stock }}</td>

                                            <td class="text-end">
                                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('productos.show',$producto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('productos.edit',$producto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
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
                {!! $productos->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
