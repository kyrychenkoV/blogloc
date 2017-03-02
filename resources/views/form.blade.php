@extends('loyauts.site')

{{ Form::open(array('url' => 'user/contact','files'=>true)) }}

{!! csrf_field() !!}
{{--    <pre>{{ print_r(Session::all()) }}</pre>--}}

<div class="row">
    <div class="col-sm-2">
        {!! Form::label('nameCompany', 'NameCompany') !!}
    </div>
    <div class="col-sm-6">
        {!! Form::input('text', 'title', null, ['placeholder' => 'name']) !!}
    </div>
</div>
{{--        {{old($name)}};--}}

<div class="row">
    <div class="col-sm-2">
        {!! Form::label('description', 'description') !!}
    </div>
    <div class="col-sm-6">
        {!! Form::text('description', null,['placeholder' => 'desc']) !!}
        {!!Form::file('image',['class' => 'btn '])!!}
        {!! Form::token() !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
{{--        {{$name='form';}}--}}
        {!! Form::submit('Go', ['class' => 'btn btn-primary']) !!}
{{--        {!! Form::file($name, $attributes = array()) !!}--}}

    </div>
</div>
{{ Form::close() }}


