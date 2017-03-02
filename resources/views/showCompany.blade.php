@extends('loyauts.site')


{{--{{ $name}}--}}
{{--{{ $description}}--}}
{{--<img src="{{ $requests['image']}}" alt="" />--}}
{{--<img src="{{asset(($requests['image']))}}"/>--}}
{{--<img src="{{asset(' D:\xampp\tmp\phpC712.tmp')}}"/>--}}
{{--img{{ $requests['image']}}--}}
{{--<h1>{{ $url}}</h1>--}}


{{--<img src="{{asset('images/one.jpg')}}"/>--}}

@foreach ($companies as $company)
    <p> {{ $company->name }}</p>
    <p> {{ $company->description }}</p>
    <p> {{ $company->img }}</p>


@endforeach