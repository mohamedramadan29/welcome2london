<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\front\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    use Message_Trait;
    public function index()
    {
        $bookings  = Booking::all();
        return view('admin.booking.index',compact('bookings'));
    }

    public function update(Request $request,$id)
    {
        $book = Booking::findOrFail($id);

        if ($request->isMethod('post')){
            $data = $request->all();
            $book->update([
                'status'=>$data['status']
            ]);
            return  $this->success_message(' تم تعديل الحالة بنجاح  ');
        }
        return view('admin.booking.update',compact('book'));
    }
    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return $this->success_message(' تم الحذف بنجاح  ');
    }
}
