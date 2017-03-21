@extends('loyauts.site')


{{--{{ $name}}--}}
{{--{{ $description}}--}}
{{--<img src="{{ $requests['image']}}" alt="" />--}}
{{--<img src="{{asset(($requests['image']))}}"/>--}}
{{--<img src="{{asset(' D:\xampp\tmp\phpC712.tmp')}}"/>--}}
{{--img{{ $requests['image']}}--}}
{{--<h1>{{ $url}}</h1>--}}

{{--$company->img === вытягует uploads/Penguins.jpg--}}
{{--<img src="{{ asset('uploads/Penguins.jpg') }}"/>--}}



{{--<img src="{{ asset( {{$company->img}} ) }}"/>--}}
{{--<img src="{{ asset('$company->img)'}}"/>--}}
{{--<img src="{{ asset('{{$company->img}})'}}"/>--}}


@foreach ($companies as $company)
    <p> {{ $company->name }}</p>
    <p> {{ $company->description }}</p>
    <img src="{{ asset($company->img) }}">
{{--    <p> {{ $company->img }}</p>--}}
{{--    {!! link_to_route('login_path') !!}--}}
{{--    <img src="{{asset('{{ $company->img }}')}}"/>--}}
{{--    <img src="{{ asset(' {{ $destinationPath }}/{{ $company->img }} ') }}"/>--}}

{{--    <p>  <a href="{{ $company->img }}"></a></p>--}}

@endforeach