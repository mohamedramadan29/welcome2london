<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\admin\Setting;
use App\Models\front\Booking;
use App\Models\front\Payment;
use App\Models\front\Payment2;
use App\Models\front\ServiveBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;

class PaypalController extends Controller
{
    private $geteway;

    public function __construct()
    {


        $this->geteway = Omnipay::create('PayPal_Rest');
        $this->geteway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->geteway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->geteway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        $setting = Setting::find(1);
        $confirm_price = $setting->main_price;
        try {
            $paypal_amount = round($confirm_price, '2');
            $response = $this->geteway->purchase(array(
                'amount' => $paypal_amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function pay2(Request $request)
    {
        $setting = Setting::find(1);
        $confirm_price = $setting->main_price;
        try {
            $paypal_amount = round($confirm_price, '2');
            $response = $this->geteway->purchase(array(
                'amount' => $paypal_amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success2'),
                'cancelUrl' => url('error2'),
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->geteway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
            if ($response->isSuccessful()) {
                $session_id = Session::getId();
                $arr = $response->getData();
                $payment = new Payment();
                $payment->booking_id = Session::get('booking_id');
                $payment->user_session = $session_id;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();

                ////////// Update Order Status
                ///
                $booking_id = Session::get('booking_id');
                //////// Update Order Status To Paid
                ///
                Booking::where('id', $booking_id)->update(['payment_status' => ' تم الدفع وتاكيد الحجز  ']);
                return view('front.payment.success-booking');
                //return "Payment Is Success. Your Transation Is" . $arr['id'];
            } else {
                //  return $response->getMessage();
                return view('front.payment.error-booking');
            }
        } else {
            return "Payment Declined";
        }
    }


    public function success2(Request $request)
    {
        // dd(Session::get('booking_id'));
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->geteway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
            //dd($response);
            if ($response->isSuccessful()) {
                $session_id = Session::getId();
                $arr = $response->getData();
                $payment = new Payment2();
                $payment->booking_id = Session::get('booking_id2');
                $payment->user_session = $session_id;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();

                ////////// Update Order Status
                ///
                $booking_id2 = Session::get('booking_id2');
                //////// Update Order Status To Paid
                ///
                ServiveBooking::where('id', $booking_id2)->update(['payment_status' => ' تم الدفع وتاكيد الحجز  ']);
                return view('front.payment.success-booking2');
                //return "Payment Is Success. Your Transation Is" . $arr['id'];
            } else {
                //  return $response->getMessage();
                return view('front.payment.error-booking2');
            }
        } else {
            return "Payment Declined";
        }
    }

    public function errorPayment()
    {
        return view('front.payment.error-booking');
    }
}
