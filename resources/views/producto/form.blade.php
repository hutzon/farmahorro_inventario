<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('categoria') }}
            {{ Form::select('categoria_id',$categorias , $producto->categoria_id, ['class' => 'form-control' . ($errors->has('categoria_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar categoria ...']) }}
            {!! $errors->first('categoria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('principio_activo') }}
            {{ Form::text('principio_activo', $producto->principio_activo, ['class' => 'form-control' . ($errors->has('principio_activo') ? ' is-invalid' : ''), 'placeholder' => 'Principio Activo']) }}
            {!! $errors->first('principio_activo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('presentacion') }}
            {{ Form::text('presentacion', $producto->presentacion, ['class' => 'form-control' . ($errors->has('presentacion') ? ' is-invalid' : ''), 'placeholder' => 'Presentacion']) }}
            {!! $errors->first('presentacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('miligramos') }}
            {{ Form::text('miligramos', $producto->miligramos, ['class' => 'form-control' . ($errors->has('miligramos') ? ' is-invalid' : ''), 'placeholder' => 'Miligramos']) }}
            {!! $errors->first('miligramos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        {{-- <div class="form-group">
            {{ Form::label('stock') }}
            {{ Form::text('stock', $producto->stock, ['class' => 'form-control' . ($errors->has('stock') ? ' is-invalid' : ''), 'placeholder' => 'Stock']) }}
            {!! $errors->first('stock', '<div class="invalid-feedback">:message</div>') !!}
        </div> --}}

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
