<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\admin\Testmonail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TestmonailController extends Controller
{
    use Message_Trait;
    use Upload_Images;

    public function index()
    {
        $tesmonails = Testmonail::all();
        return view('admin.testmonails.index', compact('tesmonails'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                $data = $request->all();
               // dd($data);
                $rules = [];
                $messages = [];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                if ($request->hasFile('image')) {
                    $imagename = $this->saveImage($request->image, public_path('assets/admin/uploads/testmonails/'));
                }
                $testmonail = new Testmonail();
                $testmonail->person_image = $imagename;
                $testmonail->person_name = $data['person_name'];
                $testmonail->person_desc = $data['person_desc'];
                $testmonail->save();
                return $this->success_message(' تمت الاضافة بنجاح  ');
            } catch (\Exception $e) {
                return $this->exception_message($e);
            }
        }
        return view('admin.testmonails.add');
    }

    public function update(Request $request, $id)
    {
        $testmon = Testmonail::findOrFail($id);
        if ($request->isMethod('post')){
            $data = $request->all();
            $testmon->update([
                'person_name'=>$data['person_name'],
                'person_desc'=>$data['person_desc'],

            ]);
            if ($request->hasFile('image')){
                $imagename = $this->saveImage($request->image, public_path('assets/admin/uploads/testmonails/'));
                $testmon->update([
                    'person_image'=>$imagename
                ]);
            }
            return $this->success_message(' تم  التعديل بنجاح  ');
        }
        return view('admin.testmonails.edit', compact('testmon'));
    }

    public function delete($id)
    {
        $testmon = Testmonail::findOrFail($id);
        $testmon->delete();
        return $this->success_message(' تم الحذف بنجاح  ');
    }
}
