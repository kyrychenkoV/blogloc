<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Helpers\Facades\Calculator;
use App\Discount;
use App\DiscountType;
class UpdateDatabaseReservation extends Controller
{
    public function updateDatabase(Request $request, $id)
    {
        $order = Reservation::where('guid', $id)->first();

//        $codeDiscount = Discount::all()->where('identifier', $order->pr_code)->first();
//        $codeDiscount->is_valid=0;
//        $codeDiscount->save();


        $reservation = Reservation::where('guid', $id)->get()->first();
        $data = $request->all();
        $reservation->name = $data['name'];
        $reservation->discount_type_id = $data['discount'];
        $dateFrom = \DateTime::createFromFormat('d.m.Y', $data['fromdate']);
        $reservation->date_from = $dateFrom->format('Y-m-d');
        $reservation->time_from = $data['fromtime'];
        $dateTo = \DateTime::createFromFormat('d.m.Y', $data['todate']);
        $reservation->date_to = $dateTo->format('Y-m-d');
        $reservation->time_to = $data['totime'];
        $reservation->price = Calculator::calculate($data);
        $reservation->pr_code=$data['pr-code'];
        $reservationModel = new Reservation();
        $isValid = $reservationModel->validate([$data]);

//        if(session('promocode')!=$data['pr-code']){
////            dd("lalala0");
//        }
        if ($isValid) {
            $reservation->save();
            session()->forget('promocode');
            return response()->json($reservation->price);
//
        } else {
//            return redirect()->back();
            return redirect()->route('show.guid', ['guid' => $id])->withInput()->withErrors($reservationModel->getErrorsMessages());
        }
    }
}
