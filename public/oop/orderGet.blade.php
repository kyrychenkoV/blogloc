
<link rel="stylesheet" href="{{ asset('/assets/css/reservation.css') }}"/>
<script src="{{ asset('/assets/js/order.js') }}"></script>
<script src="{{ asset('/assets/js/DataPickerUA.js') }}"></script>
<meta name="csrf_token" content="{{ csrf_token() }}" />


    <div id="banner" class="box container no-overflow">
        <div id="banner-wrapper">
            {{--@if(count($errors)>0)--}}
            <div class="alert alert-danger" style="display:none">
                <ul>
                    {{--@foreach($errors->all() as $error)--}}
                    {{--                    <li>{{$error}}</li>--}}
                    {{--<li></li>--}}
                    {{--@endforeach--}}
                </ul>
            </div>
            {{--@endif--}}
        <table id="reserv-table" datarows=1>
{{--            <form id="second-form" method="POST" action="{{route('update.reservation',['guid'=>$arr['guid']]) }}">--}}
            <form id="second-form">
                {{ csrf_field() }}
                <tr>
                    <th rowspan="2">№</th>
                    <th rowspan="2">Клієнт</th>
                    <th rowspan="2">Пільга</th>
                    <th rowspan="2">Промокод</th>
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
                    <td>1</td>
                    <td>
                         <input type="text" class="hide-field" name="name" form="second-form" placeholder="Введіть ім'я клієнта №" value="{{$arr['name'] or ''}}" required>
                    </td>
                    <td>
                        <select name="discount" form="second-form"  class="hide-field" id="myselect" required>
                            @foreach ($discountTypes as $discountType)
                                <option value="{{$discountType->id}}"
                                @if ($discountType->id == $arr['discount_type_id']){{'selected'}} @endif>
                                    {{$discountType->discountname}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <?php ?>

                    <td>
                        <input type="text" name="{{"pr-code"}}" form="second-form" class="promo-code-input hide-field" value="{{$arr['pr_code']}}"  style="background: white" maxlength="8" >
                        {{--<input type="text" name="{{$loop->iteration."[pr-code]"}}" form="second-form" class="promo-code-input" value="{{$reservation['pr-code'] or ''}}" maxlength="8" disabled>--}}
                    </td>

                    <td>
                        <input type="text" id="from" class="date-pck fromdate hide-field" name="fromdate" value="{{$dateTime['date_from']}}" form="second-form" required>
                    </td>
                    <td>
                        <input type="time" name="fromtime" class="hide-field"  value="{{$dateTime['time_from'] or '09:00'}}" form="second-form" required>
                    </td>
                    <td>
                         <input type="text" id="to" class="date-pck todate hide-field" name="todate" value="{{$dateTime['date_to']}}" form="second-form" required>
                    </td>
                    <td>
                         <input type="time" name="totime" class="hide-field"  value="{{$dateTime['time_to'] or '20:00'}}" form="second-form" required>
                    </td>
                    <td class="guid">{{$arr['guid']}}</td>
                    <td> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($arr['guid'])) !!} "></td>
                    <td class="pricetd"></td>
                </tr>
            </form>
        </table>
        <div class="-1u 3u -2u(medium) 5u(medium) 12u(small) done-btn " style="float:right; margin-top:20px">
            <input type="submit" name="OK" id="reserv-done-btn" value="Зберегти" form="second-form" >
        </div>
        <div class="-1u 3u -2u(medium) 5u(medium) 12u(small)" id="src" style="display: none; float:right; margin-top:20px">
            <input type="submit" name="OdsdK" id="reserv-done-btn1"  value="Повернутись" form="second-form" >
        </div>

    </div>

</div>
<script>
$(document).ready(function(){
    if($("#myselect").val()!=6){
        $('.promo-code-input').prop("disabled", true);
    }

    $("#reserv-done-btn").click(function () {

        var id=$('.guid').html();
        var x = $('form').serializeArray();

            $.ajax({
                url: "/booking/update/"+id,
                method: 'post',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: x,
                success: function (result) {
                       if(result.isValid){

                        for (var i=0;i<result.errors.length;i++) {
                            $(".alert-danger").show()
                            $('.alert-danger ul').append(
                                $('<li>').html(result.errors[i]))
                        }
                    }
                    else{
                        $("#reserv-done-btn").prop("disabled", true);
                        console.log('dfsdf');
//                        $(".alert-danger").remove()
//                        var o = JSON.parse(data);
//                        console.log(JSON.parse(data1));
                        $(".hide-field").prop( "disabled", true ).css("background-color","white");
                        $("#src").show("slow");
                    }
                }
            });

            return false;
    });

});

$("#reserv-done-btn1 ").click(function () {
        history.back();
               return false;
    });
$("#myselect").change(function (){
    if($("#myselect").val()==6){
        $('.promo-code-input').prop("disabled", true);
    }
    else{
        $('.promo-code-input').css("background","white").prop("disabled", false );
    }
});

</script>