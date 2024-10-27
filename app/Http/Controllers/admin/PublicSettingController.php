<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\admin\PublicSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PublicSettingController extends Controller
{

    use Message_Trait;
    public function index()
    {
        $setting = PublicSetting::first();
        return view('admin.PublicSetting.index',compact('setting'));
    }
    public function update(Request $request)
    {
        $setting = PublicSetting::first();
        try {
            $data = $request->all();
            $setting->update([
                'phone'=>$data['phone'],
                'email'=>$data['email'],
                'address'=>$data['address'],
                'work_time'=>$data['time_work'],
                'facebook_link'=>$data['facebook_link'],
                'twitter_link'=>$data['twitter_link'],
                'tiktok_link'=>$data['tiktok_link'],
            ]);
            return $this->success_message('تم التعديل بنجاح ');
        }catch (\Exception $e){
            return $this->exception_message($e);
        }
    }
}
