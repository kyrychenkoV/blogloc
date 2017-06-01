<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Helpers\Facades\Calculator;
use App\Discount;
use App\DiscountType;
use App\Http\Controllers\Session;



class UpdateDatabaseReservation extends Controller
{
    public $testErrors=array();

    public function updateDatabase(Request $request, $id)
    {
        $data = $request->all();
        $reservationModel = new Reservation();
        $isValid = $reservationModel->validate([$data]);

        if ($isValid) {
            $reservation = Reservation::where('guid', $id)->get()->first();
            $reservation->name = $data['name'];
            $reservation->discount_type_id = $data['discount'];
            $dateFrom = \DateTime::createFromFormat('d.m.Y', $data['fromdate']);
            $reservation->date_from = $dateFrom->format('Y-m-d');
            $reservation->time_from = $data['fromtime'];
            $dateTo = \DateTime::createFromFormat('d.m.Y', $data['todate']);
            $reservation->date_to = $dateTo->format('Y-m-d');
            $reservation->time_to = $data['totime'];

            $discount = new Discount();

            if (array_key_exists('pr-code', $data)) {
                $PrCode = Discount::all()->where('identifier', $data['pr-code'])->first();
                if ($PrCode != null && $PrCode->one_time_only == 1 && ($PrCode->is_valid == 1 || session('promocode') == $data['pr-code'])) {
                    $reservation->price = Calculator::calculate($data);
                    $PrCode->is_valid = 0;
                    $PrCode->save();
                    $reservation->pr_code = $data['pr-code'];
                    if (session()->has('promocode') && (session('promocode') != $data['pr-code'])) {
                        $discount->statePromocode(session('promocode'), 1);
                    }
                }
                else {
                    return response()->json([
                        "isValid"  => 1,
                        "errors"   => [0=>"Промокод не дійсний помилка"],

                    ]);
                }
            } else {
                if (!empty(session('promocode'))) {
                    $reservation->price = Calculator::calculate($data);
                    $reservation->pr_code = "";
                    $discount->statePromocode(session('promocode'), 1);
                } else {
                    $reservation->price = Calculator::calculate($data);
//                    $discount->statePromocode($data['pr-code'], 0);
                }
            }
            $reservation->save();
            session()->forget('promocode');

            return response()->json([
                "isValid"  => 0,
            ]);
        } else {
            return response()->json([
                "isValid"  => 1,
                "errors"   => $reservationModel->getErrorsMessages(),
            ]);
//            return redirect()->route('show.guid', ['guid' => $id])->withInput()->withErrors($reservationModel->getErrorsMessages());
        }
    }
}
