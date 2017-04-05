@extends('layouts.main_lay')
<link rel="stylesheet" href="{{ asset('/assets/css/reservation.css') }}"/>
<div id="banner-wrapper">
    <!-- 	<span id="order-form"></span>	this is an anchor -->
    <div id="banner" class="box container no-overflow">

        <h1>Ваше замовлення збережено</h1>
        <table id="order-table" datarows="">
            <tr>
                <th rowspan="2">№</th>
                <th rowspan="2">Клієнт</th>
                <th rowspan="2">Пільга</th>
                <th colspan="2">Початок періоду</th>
                <th colspan="2">Кінець періоду</th>
                <th rowspan="2">Ціна</th>
            </tr>
            <tr>
                <th>Дата</th>
                <th>Час</th>
                <th>Дата</th>
                <th>Час</th>
            </tr>

            <?php $i=1;var_dump($options) ?>
            @foreach ($options as $key->$value)
                {{ $key }}
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$key['1']['name']}}</td>
                    <td>{{$discountTypes[$item['discount']-1]->discountname}}</td>
                    <td>{{$item['fromdate']}}</td>
                    <td>{{$item['fromtime']}}</td>
                    <td>{{$item['todate']}}</td>
                    <td>{{$item['totime']}}</td>
                    <td>{{$prices[$i-2]}}</td>
                </tr>
            @endforeach


        </table>



    </div>

</div>
