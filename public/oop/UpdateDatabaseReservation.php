<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Lib\Calculator;

class UpdateDatabaseReservation extends Controller
{
    public function updateDatabase(Request $request, $id)
    {

        $reservation = Reservation::where('guid', $id)->get()->first();
        $data = $request->all();
            var_dump($data);
        dd($data);
        $reservation->name = $data[1]['name'];
        $reservation->discount_type_id = $data[1]['discount'];
        $dateFrom = \DateTime::createFromFormat('d.m.Y', $data[1]['fromdate']);
        $reservation->date_from = $dateFrom->format('Y-m-d');
        $reservation->time_from = $data[1]['fromtime'];
        $dateTo = \DateTime::createFromFormat('d.m.Y', $data[1]['todate']);
        $reservation->date_to = $dateTo->format('Y-m-d');
        $reservation->time_to = $data[1]['totime'];
        $reservation->price = Calculator::calculate($data[1]);

        $reservationModel = new Reservation();
        $isValid = $reservationModel->validate([$data[1]]);
        if ($isValid) {
            $reservation->save();

            return redirect()->route('show.guid', ['guid' => $id]);
        } else {
            return redirect()->back()->withErrors($reservationModel->getErrorsMessages());
        }
    }
}
