<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\DiscountType;
use App\Bookingfact;
use App\Reservation;
use App\Lib\BookingCalculate;
use Dompdf\Dompdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DateTime;

class PDFController extends Controller
{
    public function getPDF(Request $request){


        $discountTypes = DiscountType::orderBy('id', 'asc')->get();
        $reservation=new Reservation();
        $order=$reservation->formatDateTime($request->guid);

    	$pdf = PDF::loadView('pdf.customer', ['$order' => $order,'discountTypes'=>$discountTypes]);
    	return $pdf->stream('customer.pdf');
//        return view('pdf.customer',['arr' => $order,'discountTypes'=>$discountTypes]);
    }
    public function getAllPDF(Request $request){

        $order = Reservation::where('guid', $request->guid)->first();
        $orders=Reservation::where( 'bookingfacts_id',$order->bookingfacts_id)->get();
        $i=1;
        foreach ($orders as $order){
            $date_from = DateTime::createFromFormat('Y-m-d', $order->date_from);
            $time_from = DateTime::createFromFormat('H:i:s', $order->time_from);
            $date_to = DateTime::createFromFormat('Y-m-d', $order->date_to);
            $time_to = DateTime::createFromFormat('H:i:s', $order->time_to);
            $dateTime[] = [
                'date_from' => $date_from->format('d.m.Y'),
                'time_from' => $time_from->format('H:i'),
                'date_to'   => $date_to->format('d.m.Y'),
                'time_to'   => $time_to->format('H:i'),
            ];
            $order['dateTime']=$dateTime;
            $order['number']=$i++;
        }
        $discountTypes = DiscountType::orderBy('id', 'asc')->get();

        $pdf = PDF::loadView('pdf.customerAll', ['orders' => $orders,'discountTypes'=>$discountTypes,'dateTime'=> $dateTime]);
        return $pdf->stream('customerAll.pdf');
//        return view('pdf.customerAll',['orders' => $orders->toArray(),'discountTypes'=>$discountTypes,'dateTime'=> $dateTime]);
    }
}
