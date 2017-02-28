@extends('loyauts.site')

@section('content')

<!--    --><?php
//
//    echo Form:: open(array('url' => 'register','files'=>true)) ;
//    echo Form::label('nameCompany', 'NameCompany') . Form::text('nameCompany', Input::old('nameCompany'));
//    echo Form::label('sector', 'Sector') . Form::text('sector', Input::old('sector'));
//    echo Form::label('description', 'Description') . Form::password('description');
//
//    echo Form::submit('Register!');
//    echo Form::submit('Add logo');
//    echo Form::token() . Form::close();
//
//    ?>

      {{ Form::open(array('url' => 'register','files'=>true)) }}

      <div class="row">
          <div class="col-sm-2">
              {!! Form::label('nameCompany', 'NameCompany') !!}
          </div>
          <div class="col-sm-6">
              {!! Form::input('text', 'title', null, ['placeholder' => 'name']) !!}
          </div>
      </div>

      <div class="row">
          <div class="col-sm-2">
              {!! Form::label('description', 'description') !!}
          </div>
          <div class="col-sm-6">
              {!! Form::text('description', null,['placeholder' => 'desc']) !!}
              {!!Form::file('image',['class' => 'btn btn-primary'])!!}
              {!! Form::token() !!}
          </div>
      </div>

      <div class="row">
          <div class="col-sm-6">
              {!! Form::submit('Go', ['class' => 'btn btn-primary']) !!}
              {{--{!! Form::file($name, $attributes = array()) !!}--}}

         </div>
     </div>
     {{ Form::close() }}
       Ну от роби бренч називай
    його якось  і починай
       Задача така
       Додати логотип на сторінку компанії
       Для цього:
       1. На формі додавання компаії додати можливість завантажувати картинки
       2. Коли форма засабмітилась файл зберігати в файловій системі
       3. Шлях до файлу в таблиці компанї (створити відповідне поле, написати міграцію яка накоитть зміни в базу )
       3. Вивести файл на  сторінку компанії
       Задача ясна?
       form
   </div>
</div>
   @foreach( $testLara as $test)
<div class="col-md-4">

<h2>{{ $test->id }} </h2>
 <p> {{ $test->title }}</p>
   {!!  $test->contetnt !!}

     {!! $test->description !!}
    <p><a class="btn btn-default" href="{{ route('articleShow',['id'=>$test->id]) }}">Подробнее</a></p>
  </div>

    @endforeach
<h1>HHHH</h1>

@endsection