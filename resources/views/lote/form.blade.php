<div class="box box-info padding-1">
    <div class="box-body">


        <div class="form-group">
            {{ Form::label('producto') }}
            {{ Form::select('producto_id',$productos ,$lote->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar producto ...']) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('proveedor') }}
            {{ Form::select('proveedor_id',$proveedores ,$lote->proveedor_id, ['class' => 'form-control' . ($errors->has('proveedor_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar proveedor ...']) }}
            {!! $errors->first('proveedor_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_ingreso') }}
            {{ Form::date('fecha_ingreso', $lote->fecha_ingreso, ['class' => 'form-control' . ($errors->has('fecha_ingreso') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Ingreso']) }}
            {!! $errors->first('fecha_ingreso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_caducidad') }}
            {{ Form::date('fecha_caducidad', $lote->fecha_caducidad, ['class' => 'form-control' . ($errors->has('fecha_caducidad') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Caducidad']) }}
            {!! $errors->first('fecha_caducidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $lote->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
