<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Slug_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    use Message_Trait;
    use Slug_Trait;
    use Upload_Images;

    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                $data = $request->all();
                // dd($data);
                $rules = [
                    'name' => 'required',
                    'price' => 'required',
                    'image' => 'required',
                    'description' => 'required',
                    'status' => 'required',
                ];
                $messages = [

                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }

                $filename = $this->saveImage($request->file('image'), public_path('assets/admin/uploads/services'));

                $service = new Service();
                $serv_slug = $this->CustomeSlug($data['name']);
                $service->create([
                    'name' => $data['name'],
                    'slug' => $serv_slug,
                    'price' => $data['price'],
                    'short_desc' => $data['short_desc'],
                    'description' => $data['description'],
                    'more_details' => $data['more_details'],
                    'status' => $data['status'],
                    'image' => $filename,
                ]);
                return $this->success_message(' تم اضافة الخدمة بنجاح   ');
            }
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
        return view('admin.services.add');
    }


    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        try {
            if
            ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'name' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                    'status' => 'required',
                ];
                if ($request->hasFile('image')) {
                    $rules['image'] = 'image|mimes:jpg,png,jpeg|max:4096';

                }
                $messages = [
                    'name.required' => 'من فضلك ادخل اسم الخدمة',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                $filename = null;
                if ($request->hasFile('image')) {
                    ////////delete Old Image
                    ///
                    $old_image = $service['image'];

                    //unlink($service['image'], public_path('assets/admin/uploads/services/' . $service['image']));

                    $filename = $this->saveImage($request->file('image'), public_path('assets/admin/uploads/services'));
                    $service->update([
                        'image' => $filename,
                    ]);
                }
                $serv_slug = $this->CustomeSlug($data['name']);
                $service->update([
                    'name' => $data['name'],
                    'slug' => $serv_slug,
                    'price' => $data['price'],
                    'short_desc' => $data['short_desc'],
                    'description' => $data['description'],
                    'more_details' => $data['more_details'],
                    'status' => $data['status'],
                ]);
                return $this->success_message(' تم تعديل الخدمة بنجاح  ');
            }

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

        return view('admin.services.edit', compact('service'));
    }



    public function delete($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();
            return $this->success_message('تم حذف  الخدمة  بنجاح');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
    }

}
