
<link rel="stylesheet" href="{{ asset('/assets/css/reservation.css') }}"/>
<script src="{{ asset('/assets/js/order.js') }}"></script>
<script src="{{ asset('/assets/js/DataPickerUA.js') }}"></script>
<div id="banner-wrapper">
    <!-- 	<span id="order-form"></span>	this is an anchor -->
    <div id="banner" class="box container no-overflow">
        <table id="order-table" datarows="">
            <tr>
                <th rowspan="2">Клієнт</th>
                <th rowspan="2">Пільга</th>
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
            <tr>
                <?php ?>
                    <td>{{$arr['name']}}</td>
                    <td>{{$discountTypes[$arr['discount_type_id']-1]->discountname}}</td>
                    <td>{{$dateTime['date_from']}}</td>
                    <td>{{$dateTime['time_from']}}</td>
                    <td>{{$dateTime['date_to']}}</td>
                    <td>{{$dateTime['time_to']}}</td>
                    <td>{{$arr['guid']}}</td>
                    <td> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($arr['guid'])) !!} "></td>
                    <td>{{$arr['price']}}</td>
                </tr>
             <table id="reserv-table" datarows=1>
                <form id="second-form" method="POST" action="{{route('update.reservation',['guid'=>$arr['guid']]) }}">
                    {{ csrf_field() }}
                    {{--<input type="hidden" name="firstForm" value="{{serialize($firstForm)}}">--}}
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
                        {{--<th rowspan="2">-</th>--}}
                    </tr>
                    <tr>
                        <th>Дата</th>
                        <th>Час</th>
                        <th>Дата</th>
                        <th>Час</th>
                    </tr>
                    <?php $i=1; ?>
                    {{--@foreach ($reservations as $reservation)--}}
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                            {{--<td class="@if (in_array('name', /*$reservation['validationError']) ) {{"valid-error"*/}} @endif ">--}}
                                <input type="text" name="{{$i."[name]"}}" form="second-form" placeholder="Введіть ім'я клієнта №{{$i}}" value="{{$arr['name'] or ''}}" required>
                            </td>
                            <td>
                            {{--<td class="@if (in_array('discount', $reservation['validationError']) ) {{"valid-error"}} @endif ">--}}
                                <select name="{{$i."[discount]"}}" form="second-form" required>
                                    @foreach ($discountTypes as $discountType)
                                        <option value="{{$discountType->id}}"
                                        @if ($discountType->id == $arr['discount_type_id']){{'selected'}} @endif>
                                            {{$discountType->discountname}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            {{--<td>--}}
                            {{--<td class="@if (in_array('pr-code', $reservation['validationError']) ) {{"valid-error"}} @endif ">--}}
                                {{--<input type="text" name="{{$i."[pr-code]"}}" form="second-form" class="promo-code-input" value="{{$reservation['pr-code'] or ''}}" maxlength="6" disabled>--}}
                           {{--</td>--}}
                            <td>
                            {{--<td class="@if (in_array('fromdate', $reservation['validationError']) ) {{"valid-error"}} @endif ">--}}
                                <input type="text" id="{{'from'.$i}}" class="date-pck fromdate" name="{{$i."[fromdate]"}}" value="{{$dateTime['date_from']}}" form="second-form" required>
                            </td>
                            <td>
                            {{--<td class="@if (in_array('fromtime', $reservation['validationError']) ) {{"valid-error"}} @endif ">--}}
                                <input type="time" name="{{$i."[fromtime]"}}" value="{{$dateTime['time_from'] or '09:00'}}" form="second-form" required>
                            </td>
                            <td>
                            {{--<td class="@if (in_array('todate', $reservation['validationError']) ) {{"valid-error"}} @endif ">--}}
                                <input type="text" id="{{'to'.$i}}" class="date-pck todate" name="{{$i."[todate]"}}" value="{{$dateTime['date_to']}}" form="second-form" required>
                            </td>
                            <td>
                            {{--<td class="@if (in_array('totime', $reservation['validationError']) ) {{"valid-error"}} @endif ">--}}
                                <input type="time" name="{{$i."[totime]"}}" value="{{$dateTime['time_to'] or '20:00'}}" form="second-form" required>
                            </td>
                            <td>{{$arr['guid']}}</td>
                            <td> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($arr['guid'])) !!} "></td>
                            <td class="pricetd"></td>
                            {{--<td>--}}
                                {{--<a class="del-row" href="#">--}}
                                    {{--<i class="fa fa-scissors" aria-hidden="true"></i>--}}
                                {{--</a>--}}
                            {{--</td>--}}

                        </tr>
                        <?php $i++; ?>
                    {{--@endforeach--}}
                </form>

            </table>

        </table>
        <div class="-1u 3u -2u(medium) 5u(medium) 12u(small) done-btn">
            <input type="submit" name="OK" id="reserv-done-btn" value="Зберегти" form="second-form">
        </div>
    </div>
</div>
