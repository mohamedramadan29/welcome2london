<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\admin\Setting;
use App\Models\front\Booking;
use App\Models\front\ServiveBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ServiceBookingContoller extends Controller
{
    use Message_Trait;

    ////// Show In Admins
    ///
    public function index()
    {
        $bookings  = ServiveBooking::all();
        return view('admin.ServBooking.index',compact('bookings'));
    }
    public function update(Request $request,$id)
    {
        $book = ServiveBooking::findOrFail($id);

        if ($request->isMethod('post')){
            $data = $request->all();
            $book->update([
                'status'=>$data['status']
            ]);
            return  $this->success_message(' تم تعديل الحالة بنجاح  ');
        }
        return view('admin.ServBooking.update',compact('book'));
    }
    public function delete($id)
    {
        $booking = ServiveBooking::findOrFail($id);
        $booking->delete();
        return $this->success_message(' تم الحذف بنجاح  ');
    }
    public function booking(Request $request)
    {
       // dd('serv _booking');
        try {
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
                'travel_date' => 'required',
                'travel_time' => 'required',
                'num_person' => 'required',
                'num_pages'=>'required',
            ];
            $messages = [
                'name.required' => 'من فضلك ادخل الاسم ',
                'email.required' => ' من فضلك ادخل البريد الالكتروني ',
                'email.email' => ' من فضلك ادخل البريد الالكتروني بشكل صحيح  ',
                'phone.required' => ' من فضلك ادخل رقم الهاتف ',
                'travel_date.required' => ' من فضلك ادخل تاريخ  الرحلة  ',
                'travel_time.required' => ' من فضلك ادخل  توقيت الرحلة  ',
                'num_person.required' => ' من فضلك ادخل عدد الافراد ',
                'num_pages.required'=>' من فضلك ادخل عدد الحقائب  '
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $booking = new ServiveBooking();
            $booking->name=$data['name'];
            $booking->email=$data['email'];
            $booking->phone=$data['phone'];
            $booking->travel_date=$data['travel_date'];
            $booking->travel_time=$data['travel_time'];
            $booking->num_person=$data['num_person'];
            $booking->num_pages=$data['num_pages'];
            $booking->notes=$data['notes'];
            $booking->user_session=  $session_id;
            $booking->serv_id=$data['serv_id'];
            $booking->serv_name=$data['serv_name'];
            $booking->payment_status = ' لم يتم تاكيد الحجز  ';
            $booking->save();

            //Send Mail To Admin
            $email = env('MAIN_EMAIL');
            $MessageDate = [
                'name' => $data['name'],
                "email" => $data['email'],
                'phone' => $data['phone'],
                'travel_date' => $data['travel_date'],
                'travel_time' => $data['travel_time'],
                'num_person' => $data['num_person'],
                'serv_name' => $data['serv_name'],
                'num_pages'=>$data['num_pages']
            ];

            Mail::send('front.mails.NotifiServBooking', $MessageDate, function ($message) use ($email) {
                $message->to($email)->subject(' حجز جديد   ');
            });
            $booking_id = $booking->id;
            return Redirect::to('booking-confirm2/'.$booking_id)->with(['booking_id' => $booking_id, 'Success_message' => 'تم ارسال الحجز بنجاح من فضلك اكد طلبك الان']);
            // return $this->success_message(' تم ارسال الحجز بنجاح ');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

    }

    public function booking_confirm2($booking_id)
    {
        $booking = ServiveBooking::findOrFail($booking_id);

        Session::put('booking_id2', $booking->id);
        return view('front.booking-confirm2',compact('booking'));
    }


}


