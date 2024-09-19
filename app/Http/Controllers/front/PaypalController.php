<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\front\Booking;
use App\Models\front\Payment;
class PaypalController extends Controller
{
    public function index()
    {
        return view('front.checkout');
    }
    private function getAccessToken(): string
    {
        $headers = [
            'Content-Type'  => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . base64_encode(config('paypal.client_id') . ':' . config('paypal.client_secret'))
        ];
        $response = Http::withHeaders($headers)
            ->withBody('grant_type=client_credentials')
            ->post(config('paypal.base_url') . '/v1/oauth2/token');
        return json_decode($response->body())->access_token;
    }
    /**
     * @return string
     */

    public function create(int $amount = 10): string
    {
        $id = uuid_create();

        $headers = [
            'Content-Type'      => 'application/json',
            'Authorization'     => 'Bearer ' . $this->getAccessToken(),
            'PayPal-Request-Id' => $id,
        ];

        $body = [
            "intent"         => "CAPTURE",
            "purchase_units" => [
                [
                    "reference_id" => $id,
                    "amount"       => [
                        "currency_code" => "GBP",
                        "value"         => number_format($amount, 2),
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body))
            ->post(config('paypal.base_url'). '/v2/checkout/orders');

        Session::put('request_id', $id);
        Session::put('order_id', json_decode($response->body())->id);
        return json_decode($response->body())->id;
    }
    /**
     * @return mixed
     */
//    public function complete()
//    {
//        $url = config('paypal.base_url') . '/v2/checkout/orders/' . Session::get('order_id') . '/capture';
//        $headers = [
//            'Content-Type'  => 'application/json',
//            'Authorization' => 'Bearer ' . $this->getAccessToken(),
//        ];
//
//        $response = Http::withHeaders($headers)
//            ->post($url, null);
//        return json_decode($response->body());
//    }

    public function complete()
    {
        $url = config('paypal.base_url') . '/v2/checkout/orders/' . Session::get('order_id') . '/capture';
        $headers = [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ];

        $response = Http::withHeaders($headers)
            ->post($url, null);
        $order_details = json_decode($response->body(), true);
        if (isset($order_details['status']) && $order_details['status'] === 'COMPLETED') {
            // تحديث حالة الحجز

            $booking_id = Session::get('booking_id');
            Booking::where('id', $booking_id)->update(['payment_status' => 'تم الدفع وتأكيد الحجز']);
            return $order_details;
            // الدفع ناجح
            $payment = new Payment();
            $payment->booking_id = Session::get('booking_id');
            $payment->user_session = session()->getId();
            $payment->payment_id = $order_details['id'];
            $payment->payer_id = $order_details['payer']['payer_id'] ?? null;
            $payment->payer_email = $order_details['payer']['email_address'] ?? null;
            $payment->amount = $order_details['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $order_details['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payment_status = $order_details['status'];
            $payment->save();

            // تحديث حالة الحجز
            $booking_id = Session::get('booking_id');
            Booking::where('id', $booking_id)->update(['payment_status' => 'تم الدفع وتأكيد الحجز']);

            return response()->json(['status' => 'COMPLETED', 'message' => 'تم تأكيد الحجز بنجاح.']);
        } else {
            // الدفع فشل
            return response()->json(['status' => 'FAILED', 'message' => 'حدث خطأ أثناء الدفع.']);
        }
    }



}
