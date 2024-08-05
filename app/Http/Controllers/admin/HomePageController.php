<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\admin\HomePageControlle;
use Illuminate\Http\Request;

class HomePageController extends Controller
{

    use Message_Trait;
    use Upload_Images;

    public function update(Request $request)
    {
        $homedata = HomePageControlle::first();
        if ($request->isMethod('post')) {
            $data = $request->all();

            $homedata->update([
                'hero_first_title' => $data['hero_first_title'],
                'hero_second_title' => $data['hero_second_title'],
                'hero_desc' => $data['hero_desc'],
                'hero_phone' => $data['hero_phone'],
                'about_title' => $data['about_title'],
                'about_desc' => $data['about_desc'],
                'about_feature1' => $data['about_feature1'],
                'about_feature2' => $data['about_feature2'],
                'about_feature3' => $data['about_feature3'],
                'about_feature4' => $data['about_feature4'],
            ]);
            //////// Start Updaete IMages
            ///
            if ($request->hasFile('hero_image1')) {
                $hero_image1 = $this->saveImage($request->hero_image1, public_path('assets/admin/uploads/homepage'));
                $homedata->update([
                    'hero_image1' => $hero_image1,
                ]);
            }
            if ($request->hasFile('hero_image2')) {
                $hero_image2 = $this->saveImage($request->hero_image2, public_path('assets/admin/uploads/homepage'));
                $homedata->update([
                    'hero_image2' => $hero_image2,
                ]);
            }
            if ($request->hasFile('hero_image3')) {
                $hero_image3 = $this->saveImage($request->hero_image3, public_path('assets/admin/uploads/homepage'));
                $homedata->update([
                    'hero_image3' => $hero_image3,
                ]);
            }
            if ($request->hasFile('about_image')) {
                $about_image = $this->saveImage($request->about_image, public_path('assets/admin/uploads/homepage'));
                $homedata->update([
                    'about_image' => $about_image,
                ]);
            }
            return $this->success_message(' تم التعديل بنجاح  ');
        }

        return view('admin.settings.homepage', compact('homedata'));
    }
}
