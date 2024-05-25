<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('lote') }}
            {{ Form::select('lote_id', $lotes, $movimiento->lote_id, ['class' => 'form-control', 'placeholder' => 'Seleccione un Id ...', 'onchange' => 'fetchProductName()', 'id' => 'lote_id']) }}
        </div>
        <div class="form-group">
            {{ Form::label('producto', 'Producto') }}
            {{ Form::text('producto', $productoNombre ?? '', ['class' => 'form-control', 'id' => 'producto', 'readonly' => true]) }}
        </div>

        <div class="form-group">
            {{ Form::label('tipo') }}
            {{-- {{ Form::text('tipo', $movimiento->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }} --}}
            {{ Form::select('tipo', $tipos, $movimiento->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo ...']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $movimiento->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
                <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::date('fecha', $movimiento->fecha ? $movimiento->fecha->format('Y-m-d') : null, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $movimiento->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>

