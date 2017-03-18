<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;

use App\Models\Backend\Banner;
use App\Models\Backend\Profile;
use App\Models\Access\User\User;
use Illuminate\Http\Request;
/**
 * Class FrontendController.
 */
class FrontendController extends AppBaseController
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $banners = Banner::get();
        $profiles = Profile::where('is_recommand', 1)->get();
        
        $gb2260 = new \GB2260\GB2260();
        foreach($profiles as $profile) {
            $profile->user = User::find($profile->user_id);
            
            $city = $gb2260->get($profile->city_id); 
            $city = explode(" ", $city)[0];
            $province = $gb2260->get($profile->prov_id); 
            
            $profile->province_city_name = "$province $city";
            $profile->province_city = $profile->prov_id."," .$profile->city_id;
        }
        return view('frontend.index', compact('banners', 'profiles'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    public function upload(Request $request) 
    {
        $files = $request->file();
        foreach($files as $key=>$file) {
            $path = upload($request, $key);
        }
    
        return $this->sendResponse(['path'=>$path], '上传成功');
    }

    public function setting() {
        return view('frontend.setting');
    }
}
