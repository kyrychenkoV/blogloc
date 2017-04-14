<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiscountType;
use App\Bookingfact;
use App\Reservation;
use App\Lib\BookingCalculate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Mail\Message;
use App\Lib\Calculator;

class BookingController extends Controller
{
    public $firstForm, $discountTypes, $prices = [], $reservations, $bookingfact;

    function __construct(Request $request)
    {
        $this->firstForm = unserialize($request['firstForm']);
        $this->discountTypes = DiscountType::orderBy('id', 'asc')->get();
    }

    public function confirm(Request $request)
    {
        $this->reservations = $request->except(['_token', 'OK', 'firstForm']);
        $reservationModel = new Reservation();
        $this->reservations = $reservationModel->calculatePrices($this->reservations);

        $this->prices = $reservationModel->getPrice();

        $bool = $reservationModel->validate($this->reservations);
//        dd($reservationModel->getErrorsMessages());
        $i = 0;
        foreach ($this->reservations as &$reservation) {
            $i++;
            $reservation['number'] = $i;
            $reservation['guid'] = $reservationModel->getGuid($reservation);
            $reservation['orderPrice'] = array_sum($this->prices);
            $a = $reservationModel->getField();
            $reservation['validationError'] = $a[$i - 1];
        }
//        dd($bool);
        if (!$bool) {
//         dd($reservationModel->getErrorsMessages());
            return view('View_reservation', $this->dataArray())->withErrors($reservationModel->getErrorsMessages());
        }
        return view('View_booking', $this->dataArray());
    }

    public function save(Request $request)
    {
        $this->reservations = unserialize($request->input('reservations'));
        $bookingfact = $request->except(['_token', 'OK', 'reservations', 'firstForm']);
        $newBookingfact = new Bookingfact;
        if (!$newBookingfact->validateAndSave($bookingfact)) {
            return view('View_booking', ['reservations' => $this->reservations, 'discountTypes' => $this->discountTypes,
                'firstForm' => $this->firstForm,
                'bookingfact' => $bookingfact, 'prices' => $this->prices])->withErrors($newBookingfact->getErrorsMessages());
        } else {
//            dd($this->reservations);
            Reservation::andSave($this->reservations);
        }
        return redirect()->guest(route('show.postShow', ['array' => $this->dataArray()]));
    }

    public function show(Request $request)
    {
        return view('View_order', ['array' => $request->all(), 'discountTypes' => $this->discountTypes]);
    }

    public function showGet($guid)
    {
//        dd($guid);
//
        $reservation = Reservation::where('guid', $guid);
        dd($reservation->get()->all());
    }

    private function preparationArray()
    {
        $reservationModel = new Reservation();
        $i = 0;
//        dd($this->reservations);
        foreach ($this->reservations as &$reservation) {

//            dd($this->prices);
            $i++;
            $reservation['number'] = $i;
            $reservation['guid'] = $reservationModel->getGuid($reservation);
            $reservation['orderPrice'] = array_sum($this->prices);

        }
    }

    private function dataArray()

    {
//        dd($this->discountTypes);
        $data = [

            'reservations' => $this->reservations,
            'discountTypes' => $this->discountTypes,
            'firstForm' => $this->firstForm,
        ];
        return $data;
    }
}