<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiscountType;
use App\Bookingfact;
use App\Reservation;
use App\Lib\BookingCalculate;

class BookingController extends Controller
{
	public $firstForm, $discountTypes, $prices = [], $reservations;
    public $options = [
        'reservations' => '$this->reservations',
        'discountTypes' => '$this->discountTypes',
        'firstForm'=>'$this->firstForm'

    ];
	function __construct (Request $request)
	{
		$this->firstForm = unserialize($request['firstForm']);
		$this->discountTypes = DiscountType::orderBy('id', 'asc')->get();
	}

 	public function confirm(Request $request)
	{
		$this->reservations = $request->except(['_token', 'OK', 'firstForm']);
		if (BookingCalculate::calculatePrices ($this) )
			return view ('View_booking',['reservations'=>$this->reservations, 'discountTypes'=>$this->discountTypes, 
										'firstForm'=>$this->firstForm, 'prices'=>$this->prices ]);
		
//		echo "<script> history.pushState({}, null, '/reservation');</script>";	//URLfix - should we do it???
		return view ('View_reservation',[	'discountTypes'=>$this->discountTypes, 
			'firstForm'=>$this->firstForm, 'reservations'=>$this->reservations ]);
	}

	public function save(Request $request)	
	{
		$this->reservations = unserialize( $request->input('reservations') );
		$bookingfact = $request->except(['_token', 'OK', 'reservations', 'firstForm']);
		if (!BookingCalculate::calculatePrices ($this) )
		{
//			echo "<script> history.pushState({}, null, '/reservation');</script>";	//URLfix - should we do it???
			return view ('View_reservation',[	'discountTypes'=>$this->discountTypes, 
				'firstForm'=>$this->firstForm, 'reservations'=>$this->reservations ]);
		}

		$newBookingfact = new Bookingfact;
		if (! $newBookingfact->validateAndSave($bookingfact) )
		{																		//URLfix - should we do it???	
//			echo "<script> history.pushState({}, null, window.location.hostname + '/booking');</script>";
			return view ('View_booking',['reservations'=>$this->reservations, 'discountTypes'=>$this->discountTypes, 
				'validationError'=>$newBookingfact->errorMessages->keys(), 'firstForm'=>$this->firstForm, 
				'bookingfact'=>$bookingfact, 'prices'=>$this->prices  ]);
		}

		foreach ($this->reservations as $reservation) Reservation::andSave($reservation);
        $options = array(
            'reservations' => $this->reservations,
           ' discountTypes' => $this->discountTypes,
            'firstForm'=>$this->firstForm,

        );
        var_dump($options);
        dump( $options);
        echo "<h1>Ваше замовлення збережено</h1>";
		dump($bookingfact, $this->reservations,$this->options);
        return view ('order')->with('options',$options);
	}
}