
<!DOCTYPE html>

<html>
<head>
	<title>Замовлення</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
{{--    <link rel="stylesheet" href="{{ asset('/assets/css/reservation.css') }}"/>--}}
    <style type="text/css">
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt
        }

        TABLE {
            border-collapse: collapse; /* Убираем двойные границы между ячейками */
            text-align: center;
            border: 2px solid #000; /* Рамка вокруг таблицы */
        }
        TD, TH {
            padding: 5px; /* Поля вокруг текста */
            border: 1px solid #000; /* Рамка вокруг ячеек */
        }
        h1{
            text-align:center;
        }

    </style>
</head>
<body>
<h1>ВАШЕ ЗАМОВЛЕННЯ №{{$order['bookingfacts_id']}}</h1>
<?php  ?>
<div id="banner-wrapper">
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
                    <td>{{$order['name']}}</td>
                    <td>{{$discountTypes[$order['discount_type_id']-1]->discountname}}</td>
                    <td>{{$order['dateTime']['date_from']}}</td>
                    <td>{{$order['dateTime']['time_from']}}</td>
                    <td>{{$order['dateTime']['date_to']}}</td>
                    <td>{{$order['dateTime']['time_to']}}</td>
                    <td>{{$order['guid']}}</td>
                    <td> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($order['guid'])) !!} "></td>
                    <td>{{$order['price']}}</td>
                </tr>
        </table>
    </div>
</div>
</body>
</html>