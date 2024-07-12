<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use Message_Trait;
    public function index()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Admin Login
    public function admin_login(Request $request)
    {
        $data_lgoin = $request->all();
        try {
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $customMessage = [
                'email.required' => 'من فضلك ادخل البريد الإلكتروني',
                'email.email' => 'من فضلك ادخل بريد الكتوني صحيح',
                'password.required' => 'من فضلك ادخل كلمة المرور',
            ];
            $this->validate($request, $rules, $customMessage);
            $email = $data_lgoin['email'];
            $password = $data_lgoin['password'];
            if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
                if (Auth::guard('admin')->user()->status == 1) {
                    return redirect('admin/dashboard');
                } else {
                    return $this->Error_message('غير مصرح لك بالدخول كادمن');
                }
            } else {
                return $this->Error_message('لا يوجد سجل بهذة البيانات ');
            }

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
    }
    // Update admin Details


    // check admin password in client side
    public function check_admin_password(Request $request)
    {
        $data = $request->all();
        $old_password = $data['current_password'];
        if (Hash::check($old_password, Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    /////// Update Admin Password /////////////
    public function update_admin_password(Request $request)
    {
        if ($request->isMethod('post')) {

            $request_data = $request->all();
            //check if old password is correct or not
            if (Hash::check($request_data['old_password'], Auth::guard('admin')->user()->password)) {
                // check if the new password == confirm password
                if ($request_data['new_password'] == $request_data['confirm_password']) {
                    $admin_user = admin::where('id', Auth::guard('admin')->user()->id);
                    $admin_user->update([
                        'password' => bcrypt($request_data['new_password'])
                    ]);
                    $this->success_message('تم تعديل كلمة المرور بنجاح');
                } else {
                    $this->Error_message('يجب تأكيد كلمة المرور بشكل صحيح');
                }
            } else {
                $this->Error_message('كلمة المرو القديمة غير صحيحة');
            }
        }
        $adminDetails = admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.settings.update_admin_password', compact('adminDetails'));
    }

    ///////////////// Update Admin Details  //////////
    public function update_admin_details(Request $request)
    {
        $admin_data = admin::where('id', Auth::guard('admin')->user()->id)->first();
        $id = $admin_data['id'];
        if ($request->isMethod('post')) {
            $all_update_data = $request->all();
            ////////////////////// Make Validation //////////////
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:admins,email,' . $id,
                'phone' => 'required|numeric|digits_between:8,11',
            ];
            $customeMessage = [
                'name.required' => 'من فضلك ادخل الأسم',
                'name.regex' => 'من فضلك ادخل الأسم بشكل صحيح ',
                'email.required' => 'من فضلك ادخل البريد الألكتروني',
                'email.email' => 'من فضلك ادخل البريد الألكتروني بشكل صحيح',
                'email.unique' => 'هذا البريد الألكتروني موجود من قبل من فضلك ادخل بريد الكتروني جديد',
                'phone.required' => 'من فضلك ادخل رقم الهاتف',
                'phone.digits_between' => 'رقم الهاتف يجب ان يكون من 8 الي 11 رقم',
            ];
            $this->validate($request, $rules, $customeMessage);
            /// Upload Admin Photo
            if ($request->hasFile('image')) {

                $img_tmp = $request->file('image');
                if ($img_tmp->isValid()) {
                    $image = $request->file('image')->store('public/admin/images/admin_images');
                    // delete old image
                    if ($admin_data['image'] != '') {
                        Storage::delete($admin_data['image']);
                    }
                    $admin_data->update([
                        'image' => $image,
                    ]);
                }
            }
            $admin_data->update([
                'name' => $all_update_data['name'],
                'email' => $all_update_data['email'],
                'phone' => $all_update_data['phone'],

            ]);
            $this->success_message('تم تحديث البيانات بنجاح');
            //            return redirect()->back()->with(['Success_message'=>'']);
        }
        return view('admin.settings.update_admin_data', compact('admin_data'));
    }







//////////////////// LogOut /////////////

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

}
