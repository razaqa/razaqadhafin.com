<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
    {!! Form::label('desc', 'Description', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('desc', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('desc') }}</strong>
        </span>
    </div>
</div>
