<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\admin\HomePageControlle;
use App\Models\admin\Service;
use App\Models\admin\Setting;
use App\Models\admin\Testmonail;
use App\Models\front\Booking;
use App\Models\front\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    use Message_Trait;

    public function index()
    {

        $services = Service::all();
        $testmonails = Testmonail::all();
        $homedata = HomePageControlle::first();
        return view('front.index', compact('services','testmonails','homedata'));
    }

    public function services()
    {
        $services = Service::all();
        return view('front.services', compact('services'));
    }

    ///////////// Start booking /////////////

    public function booking(Request $request)
    {
        if ($request->isMethod('post')) {
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }
            //  dd($session_id);
            $data = $request->all();
            //dd($data);
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'place_from' => 'required',
                'place_to' => 'required',
                'travel_date' => 'required',
                'travel_time' => 'required',
                'num_person' => 'required',
                'num_pages' => 'required',


            ];
            $messages = [
                'name.required' => 'من فضلك ادخل الاسم ',
                'email.required' => ' من فضلك ادخل البريد الالكتروني ',
                'email.email' => ' من فضلك ادخل البريد الالكتروني بشكل صحيح  ',
                'phone.required' => ' من فضلك ادخل رقم الهاتف ',
                'place_from.required' => ' من فضلك ادخل مكان بداية الرحلة  ',
                'place_to.required' => ' من فضلك ادخل مكان نهاية  الرحلة  ',
                'travel_date.required' => ' من فضلك ادخل تاريخ  الرحلة  ',
                'travel_time.required' => ' من فضلك ادخل  توقيت الرحلة  ',
                'num_person.required' => ' من فضلك ادخل عدد الافراد ',
                'num_pages.required' => ' من فضلك ادخل عدد الحقائب  ',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $booking = new Booking();
            $booking->name=$data['name'];
            $booking->email=$data['email'];
            $booking->phone=$data['phone'];
            $booking->place_from=$data['place_from'];
            $booking->place_to=$data['place_to'];
            $booking->travel_date=$data['travel_date'];
            $booking->travel_time=$data['travel_time'];
            $booking->num_person=$data['num_person'];
            $booking->notes=$data['notes'];
            $booking->user_session=  $session_id;
            $booking->num_pages=$data['num_pages'];
            $booking->payment_status = ' لم يتم تاكيد الحجز  ';
            $booking->save();

            //Send Mail To Admin
            $email = env('MAIN_EMAIL');
            $MessageDate = [
                'name' => $data['name'],
                "email" => $data['email'],
                'phone' => $data['phone'],
                'place_from' => $data['place_from'],
                'place_to' => $data['place_to'],
                'travel_date' => $data['travel_date'],
                'travel_time' => $data['travel_time'],
                'num_person' => $data['num_person'],
                'num_pages' => $data['num_pages'],
            ];
            Mail::send('front.mails.NotifiNewBooking', $MessageDate, function ($message) use ($email) {
                $message->to($email)->subject(' حجز جديد   ');
            });
//            $booking_id = $booking['id'];
//            return Redirect::to('booking-confirm',compact('booking_id'))->with(['Success_message' => ' تم ارسال الحجز بنجاح من فضلك اكد طلبك الان  ']);

            ///////// Get the Price To Confirm Booking
            $setting = Setting::find(1);
            $confirm_price = $setting->main_price;

            Session::put('confirm_price',$confirm_price);

            $booking_id = $booking->id;

            return Redirect::to('booking-confirm/'.$booking_id)->with(['booking_id' => $booking_id, 'confirm_price' => $confirm_price, 'Success_message' => 'تم ارسال الحجز بنجاح من فضلك اكد طلبك الان']);
            // return $this->success_message(' تم ارسال الحجز بنجاح ');
        }
        return view('front.booking');
    }
    public function booking_confirm($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        $booking_id = $booking['id'];
        Session::put('booking_id', $booking->id);

        //dd(Session::get('booking_id'));
        return view('front.booking-confirm',compact('booking'));
    }


    ////////////////End Booking /////////////

    public function contact(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'message' => 'required',
                ];
                $messages = [
                    'name.required' => 'من فضلك ادخل الاسم ',
                    'email.required' => ' من فضلك ادخل البريد الالكتروني ',
                    'email.email' => ' من فضلك ادخل البريد الالكتروني بشكل صحيح  ',
                    'phone.required' => ' من فضلك ادخل رقم الهاتف ',
                    'message.required' => ' من فضلك ادخل رسالتك  '
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }

                $message = new Contact();
                $message->create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'message' => $data['message'],
                ]);
                ////////////////////// Send Confirmation Email ///////////////////////////////
                ///
                $email = $data['email'];

                $MessageDate = [
                    'name' => $data['name'],
                    "email" => $data['email'],
                    'phone' => $data['phone'],
                    'contact_message' => $data['message']
                ];
                Mail::send('front.mails.NotifiContactMessage', $MessageDate, function ($message) use ($email) {
                    $message->to($email)->subject(' رسالة تواصل جديدة  ');
                });
                return $this->success_message(' تم ارسال رسالتك بنجاح ');
            }
        } catch (\Exception $e) {

        }

        return view('front.contact');
    }
}
