<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DiscountType;
use App\Bookingfact;
use DateTime;
use Validator;
use App\Lib\Calculator;

class Reservation extends Model
{
	private $field;
	private $price;
	private $errorsMessages;


    public function bookingfacts()
    {
        return $this->belongsTo('App\Bookingfact');
    }

    public function discounttype()
    {
        return $this->hasOne('App\DiscountType');
    }

    public function validate($reservations)
    {
        $discountTypes = DiscountType::orderBy('id', 'asc')->get();
        $discountTypesCount = count($discountTypes);
        foreach($reservations as $reservation) {
            $validatorReservations = Validator::make($reservation, [
                'name' => 'required|max:255',
            'discount' => 'required|numeric|max:' . $discountTypesCount . '|min:1',
            'fromdate' => 'required|date',
            'fromtime' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9]?)$^'],
            'todate' => 'required|date',
            'totime' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9]?)$^']
            ]);
            if($validatorReservations->fails()){
            $messages[]=$validatorReservations->getMessageBag()->keys();
            $this->errorsMessages = $validatorReservations ->getMessageBag()->all();

            }
            else{
                $messages[]=[];
            }
        }

        $this->field=$messages;

        if ($validatorReservations->fails()) {
            return false;
        }
        return true;
    }

    public static function andSave($reservations)
    {
//        dd($reservations);
            foreach($reservations as $reservation) {
                $count = Reservation::where('guid', $reservation['guid'])->count();
//                if ($count == 0) {
                    $bookingFactId = Bookingfact::max('id');
                    $newReservation = new Reservation;
                    $newReservation->name = $reservation['name'];
                    $newReservation->datetime_from = DateTime::createFromFormat('d.m.Y H:i', $reservation['fromdate'] . " " . $reservation['fromtime'])->format('Y-m-d H:i');
                    $newReservation->datetime_to = DateTime::createFromFormat('d.m.Y H:i', $reservation['todate'] . " " . $reservation['totime'])->format('Y-m-d H:i');
                    $newReservation->discount_type_id = $reservation['discount'];

//                    dd($reservation['prices']); //162.0
//                $newReservation->price = $reservation['prices'];
                    $newReservation->price = 1;
//                    dd($newReservation->price);
                    $newReservation->bookingfacts_id = $bookingFactId;
                    $newReservation->guid = $reservation['guid'];
                    $newReservation->save();
                }
//            }
    }

    public function calculatePrices($reservations)
    {
            foreach ($reservations as &$reservation) {
            $price[]=$calkulate=Calculator::calculate($reservation);
            $reservation['prices']=$calkulate;
                          $this->price=$price;
//
            }
        unset($reservation);
//
//            dd('s');
//            dd($this->price);
        return $reservations;
    }

    public function getGuid($reservation)
    {
        $dataString = '';
        $dataString .= url()->full()
            . $reservation['name']
            . $reservation['discount']
            . $reservation['fromdate']
            . $reservation['fromtime']
            . $reservation['todate']
            . $reservation['totime'];
//            . $reservation['prices'];
        $hash = strtoupper(md5($this->getRandomString($dataString)));
        $hyphen = chr(45);
        $openBracket = chr(123);
        $closeBracket = chr(125);
        $uuid = $openBracket
            . substr($hash, 0, 8) . $hyphen
            . substr($hash, 8, 4) . $hyphen
            . substr($hash, 12, 4) . $hyphen
            . substr($hash, 16, 4) . $hyphen
            . substr($hash, 20, 12)
            . $closeBracket;
        return $uuid;
    }
    private function getRandomString($dataString)
    {
        $randomString = '';
        for ($i = 0; $i < strlen($dataString) - 1; $i++) {
            $randomString .= $dataString[rand(0, strlen($dataString) - 1)];
        }
        return $randomString;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getField(){
        return $this->field;
    }
    public function getErrorsMessages(){
        return $this->errorsMesages;

    }
}