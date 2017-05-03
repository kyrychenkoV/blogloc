<link rel="stylesheet" href="{{ asset('/assets/css/reservation.css') }}"/>
<style type="text/css">


    @media print { /* Стиль для печати */
       #header,footer {
            display: none;
        }

        #order-table{
        width: 72%; border-collapse: collapse;
            /*/*table-layout: fixed; !* Ячейки фиксированной ширины *!*!*/
        }
        #banner{
            margin:0;
        }
        img {
            padding: 2px;
            width: 100%;
        }
        .fig{
            text-align: center;
        }
        .img-code{
            padding: 5px;
            padding-right: 10px;
            border: 1px solid black;
        }
    }
    @page {
        margin: 1cm;
    }
</style>
<div id="banner-wrapper">
    <!-- 	<span id="order-form"></span>	this is an anchor -->
    <div id="banner" class="box container no-overflow">
        <h1>Ваше замовлення збережено.</h1>
        <table id="order-table" datarows="">
            <tr>
                <th rowspan="2">№</th>
                <th rowspan="2">Клієнт</th>
                <th rowspan="2">Пільга</th>
                <th colspan="2">Початок періоду</th>
                <th colspan="2">Кінець періоду</th>
                <th rowspan="2" class="show-code">Унікальний код</th>
                <th rowspan="2" class="img-code">Qr code</th>
                <th rowspan="2">Ціна</th>
                <th rowspan="2" class="save">Зберегти</th>
                <th rowspan="2">Друк</th>

            </tr>
            <tr>
                <th>Дата</th>
                <th>Час</th>
                <th>Дата</th>
                <th>Час</th>
            </tr>

            @foreach ($reservations as $value)
                <tr>
                    <td>{{$value['number']}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$discountTypes[$value['discount']-1]->discountname}}</td>
                    <td>{{$value['fromdate']}}</td>
                    <td>{{$value['fromtime']}}</td>
                    <td>{{$value['todate']}}</td>
                    <td>{{$value['totime']}}</td>
                    <td><a href="{{$url=route('show.guid',['guid'=>$value['guid']])}}">{{$value['guid']}}</a></td>
                    <td><p class="fig"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($url)) !!} "></p></td>
                    <td>{{$value['price']}}</td>
                    <td class="save">{{ Html::linkRoute('getPDF', 'Зберегти в PDF', array('guid' => $value['guid'])) }}</td>
                    <th> <a href="#" onclick="printOneOrder('lala')"> <span class="glyphicon glyphicon-print"></span> </a></th>

                </tr>
            @endforeach
            <tr>
                <th colspan="9">Разом</th>
                <th>{{($reservations[1]['orderPrice'])}}</th>
                <th class="save">{{ Html::linkRoute('getPDF', 'Зберегти в PDF', array('guid' => $value['guid'])) }}</th>
                <td> <a href="#" onClick="window.print()"> <span class="glyphicon glyphicon-print"></span> </a></td>

            </tr>
        </table>

    </div>

    <script type="text/javascript">
        function printOneOrder(url) {
            console.log(url);
            alert( url );
            window.location ='http://127.0.0.1:8000/booking/0C639191-F642-57C0-C4C6-CA7F6601EB44'
                window.print()
        }
    </script>
</div>
