<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('title', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
    {!! Form::label('created_at', 'Date', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        @if( isset($post) )
            {!! Form::date('created_at', date('Y-m-d', strtotime($post->created_at)), ['class' => 'form-control', 'required']) !!}
        @else
            {!! Form::date('created_at', date('Y-m-d', strtotime(date('Y-m-d'))), ['class' => 'form-control', 'required']) !!}
        @endif
        <span class="help-block">
            <strong>{{ $errors->first('created_at') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::label('body', 'Body', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::textarea('body', null, ['class' => 'form-control', 'required', 'id'=>'editor1']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    {!! Form::label('category_id', 'Category', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('category_id') }}</strong>
        </span>
    </div>
</div>

@php
    if(isset($post)) {
        $tag = $post->tags->pluck('name')->all();
    } else {
        $tag = null;
    }
@endphp

<div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
    {!! Form::label('tags', 'Tag', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::select('tags[]', $tags, $tag, ['class' => 'form-control select2-tags', 'required', 'multiple']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('pict') ? ' has-error' : '' }}">
    {!! Form::label('pict', 'Picture', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        @if( isset($post) )
            <img id="img-preview" src="{{ asset( $post->pict ) }}" alt="your image" style="width:100%;">
            {!! Form::file('pict', null, ['class' => 'form-control', 'autofocus']) !!}
        @else
            <img id="img-preview" src="#" alt="your image" style="width:100%;">
            {!! Form::file('pict', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
        @endif

        <span class="help-block">
            <strong>{{ $errors->first('pict') }}</strong>
        </span>
    </div>
</div>
