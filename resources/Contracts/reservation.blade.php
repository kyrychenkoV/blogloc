<link rel="stylesheet" href="{{ asset('/assets/css/reservation.css') }}"/>
<script src="{{ asset('/assets/js/reservation.js') }}"></script>
<script src="{{ asset('/assets/js/DataPickerUA.js') }}"></script>

<div id="banner-wrapper">
<!-- 	<span id="order-form"></span>	this is an anchor -->
	<div id="banner" class="box container no-overflow">	
		<div class="row line2">
			<div class="4u 12u(medium)">
				<input  class="disabled-input" type="text" form="first-form" value="{{$firstForm['townName']}}" readonly>
			</div>
			
			<div class="4u 6u(medium) 12u(small)">
				<input  class="disabled-input" type="text" form="first-form" value="{{$firstForm['fromdate']}}" readonly>
			</div>	
			
			<div class="4u 6u(medium) 12u(small)">
				<input  class="disabled-input" type="text" form="first-form" value="{{$firstForm['todate']}}" readonly>
			</div>
			
			<div id="num-of-places-selector" class="4u 4u(medium) 12u(small)">
				<legend>Кількість місць:</legend>
				<input  class="disabled-input" type="text" form="first-form" value="{{$firstForm['places']}}" readonly>
			</div>
			
			<div id="" class="4u 4u(medium) 12u(small)">
				<legend>Знижка:</legend>
				<input  class="disabled-input" type="text" form="first-form" value="{{$discountTypes[$firstForm['discount']-1]->discountname}}" readonly>
			</div>
			
			<div id="promo-code-div" class="4u$ 4u$(medium) 12u$(small)">
				<legend>Промокод:</legend>
				<input class="disabled-input" type="text"  form="first-form" value="{{$firstForm['pr-code']}}" readonly>
			</div>
			
			<div class="2u text-left">
				<a  href="{{ url('/') }}" id="reserv-back-btn" class="button fa-arrow-circle-left"></a>
			</div>
			
			<div class="2u -8u">
				<a  href="#" id="reserv-frw-btn" class="button fa-arrow-circle-right"></a>
			</div>
		</div>
		
		<table id="reserv-table" datarows="{{$firstForm['places']}}">
			<form id="second-form" method="POST" action="{{url('booking')}}">
				{{ csrf_field() }}
				<input type="hidden" name="firstForm" value="{{serialize($firstForm)}}">
				<tr>
					<th rowspan="2">№</th>
					<th rowspan="2">Клієнт</th> 
					<th rowspan="2">Пільга</th>
					<th rowspan="2">Промокод</th>
					<th colspan="2">Початок періоду</th>
					<th colspan="2">Кінець періоду</th>
					<th rowspan="2">Ціна</th>
					<th rowspan="2">-</th>
				</tr>
				<tr>
					<th>Дата</th>
					<th>Час</th>
					<th>Дата</th>
					<th>Час</th>
				</tr>
			<?php $i=1; ?>
			@foreach ($reservations as $reservation)
				<tr>
					<td>{{$i}}</td>
					<td class="@if (in_array('name', $reservation['validationError']) ) {{"valid-error"}} @endif ">
						<input type="text" name="{{$i."[name]"}}" form="second-form" placeholder="Введіть ім'я клієнта №{{$i}}" value="{{$reservation['name'] or ''}}" required>
					</td>

					<td class="@if (in_array('discount', $reservation['validationError']) ) {{"valid-error"}} @endif ">
			    		<select name="{{$i."[discount]"}}" form="second-form" required>
			    			@foreach ($discountTypes as $discountType)
			    				<option value="{{$discountType->id}}" 
				    				@if ($discountType->id == $reservation['discount']){{'selected'}} @endif>
				    				{{$discountType->discountname}}
			    				</option>
			    			@endforeach
						</select>		    		
				    </td>

				    <td class="@if (in_array('pr-code', $reservation['validationError']) ) {{"valid-error"}} @endif ">
						<input type="text" name="{{$i."[pr-code]"}}" form="second-form" class="promo-code-input" value="{{$reservation['pr-code'] or ''}}" maxlength="6" disabled>
					</td>

					<td class="@if (in_array('fromdate', $reservation['validationError']) ) {{"valid-error"}} @endif ">
						<input type="text" id="{{'from'.$i}}" class="date-pck fromdate" name="{{$i."[fromdate]"}}" value="{{$reservation['fromdate']}}" form="second-form" required>
					</td>
					<td class="@if (in_array('fromtime', $reservation['validationError']) ) {{"valid-error"}} @endif ">
						<input type="time" name="{{$i."[fromtime]"}}" value="{{$reservation['fromtime'] or '09:00'}}" form="second-form" required>
					</td>
					<td class="@if (in_array('todate', $reservation['validationError']) ) {{"valid-error"}} @endif ">
						<input type="text" id="{{'to'.$i}}" class="date-pck todate" name="{{$i."[todate]"}}" value="{{$reservation['todate']}}" form="second-form" required>
					<td class="@if (in_array('totime', $reservation['validationError']) ) {{"valid-error"}} @endif ">
						<input type="time" name="{{$i."[totime]"}}" value="{{$reservation['totime'] or '20:00'}}" form="second-form" required>
					</td>
					<td class="pricetd"></td>
					<td>
						<a class="del-row" href="#">
							<i class="fa fa-scissors" aria-hidden="true"></i>
						</a>
					</td>
				</tr>
			<?php $i++; ?>
			@endforeach
			</form>
		</table>
		
		<a class="add-row" href="#">Додати строку</a>
		<br>

		<div class="4u -8u">
			<input type="submit" name="OK" id="reserv-done-btn" value="Замовити" form="second-form">
		</div>

	</div>
	
</div>
