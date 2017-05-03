
<link rel="stylesheet" href="{{ asset('/assets/css/reservation.css') }}"/>
<script src="{{ asset('/assets/js/order.js') }}"></script>
<script src="{{ asset('/assets/js/DataPickerUA.js') }}"></script>
<div id="banner-wrapper">
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
@endif

    <div id="banner" class="box container no-overflow">
        <table id="reserv-table" datarows=1>
            <form id="second-form" method="POST" action="{{route('update.reservation',['guid'=>$arr['guid']]) }}">
                {{ csrf_field() }}
                <tr>
                    <th rowspan="2">№</th>
                    <th rowspan="2">Клієнт</th>
                    <th rowspan="2">Пільга</th>
                    {{--<th rowspan="2">Промокод</th>--}}
                    <th colspan="2">Початок періоду</th>
                    <th colspan="2">Кінець періоду</th>
                    <th rowspan="2">Унікальний код</th>
                    <th rowspan="2">Qr code</th>
                    <th rowspan="2">Ціна</th>
                </tr>
                <tr>
                    <th>Дата</th>
                    <th>Час</th>
                    <th>Дата</th>
                    <th>Час</th>
                </tr>

                <?php $i=1; ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>
                         <input type="text" name="{{$i."[name]"}}" form="second-form" placeholder="Введіть ім'я клієнта №{{$i}}" value="{{$arr['name'] or ''}}" required>
                    </td>
                    <td>
                        <select name="{{$i."[discount]"}}" form="second-form" required>
                            @foreach ($discountTypes as $discountType)
                                <option value="{{$discountType->id}}"
                                @if ($discountType->id == $arr['discount_type_id']){{'selected'}} @endif>
                                    {{$discountType->discountname}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" id="{{'from'.$i}}" class="date-pck fromdate" name="{{$i."[fromdate]"}}" value="{{$dateTime['date_from']}}" form="second-form" required>
                    </td>
                    <td>
                        <input type="time" name="{{$i."[fromtime]"}}" value="{{$dateTime['time_from'] or '09:00'}}" form="second-form" required>
                    </td>
                    <td>
                         <input type="text" id="{{'to'.$i}}" class="date-pck todate" name="{{$i."[todate]"}}" value="{{$dateTime['date_to']}}" form="second-form" required>
                    </td>
                    <td>
                         <input type="time" name="{{$i."[totime]"}}" value="{{$dateTime['time_to'] or '20:00'}}" form="second-form" required>
                    </td>
                    <td>{{$arr['guid']}}</td>
                    <td> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($arr['guid'])) !!} "></td>
                    <td class="pricetd"></td>
                </tr>
                <?php $i++; ?>
            </form>
        </table>
        <div class="-1u 3u -2u(medium) 5u(medium) 12u(small) done-btn" style="float:right; margin-top:20px">
            <input type="submit" name="OK" id="reserv-done-btn" value="Зберегти" form="second-form" >
        </div>
    </div>
</div>
