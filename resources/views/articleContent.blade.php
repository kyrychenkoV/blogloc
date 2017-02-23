@extends('loyauts.site')

@section('content')
    <h1>{{ $message }}</h1>



        <div class="col-md-12">
            @if($testLara)
            {{ $testLara->id }}
             {{ $testLara->title }}
            {{  $testLara->contetnt }}

            {!! $testLara->description !!}

            @endif
        </div>


@endsection