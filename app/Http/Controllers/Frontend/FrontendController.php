<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;

use App\Models\Backend\Icon;
use App\Models\Backend\Banner;
use App\Models\Backend\Category;
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

        $profile = Profile::where('user_id', access()->user()->id)->first();

        $icons = Icon::where('type', $profile->type)
            ->orderBy('rank', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        switch($profile->type) {
        //用户只看经销商
        case \App\Models\Backend\Category::TYPE_USER:
            $type = array(
                \App\Models\Backend\Category::TYPE_AGENT
            );
        //经销商看经销商，厂商
        case \App\Models\Backend\Category::TYPE_AGENT:
            $type = array(
                \App\Models\Backend\Category::TYPE_AGENT,
                \App\Models\Backend\Category::TYPE_MANUFACTURER
            );
        case \App\Models\Backend\Category::TYPE_MANUFACTURER:
        //厂商看厂商
            $type = array(\App\Models\Backend\Category::TYPE_MANUFACTURER);
        default:
            $type = array(
                \App\Models\Backend\Category::TYPE_USER,
                \App\Models\Backend\Category::TYPE_AGENT,
                \App\Models\Backend\Category::TYPE_MANUFACTURER
            );
        }
        $profiles = Profile::where('is_recommand', 1)
            ->whereIn('type', $type)
            ->orderBy('updated_at', 'desc')
            ->orderBy('recommand_count', 'desc')
            ->limit(20)
            ->get();
        
        $gb2260 = new \GB2260\GB2260();
        foreach($profiles as $profile) {
            province_city_name($profile);
            $profile->user = User::find($profile->user_id);
        }

        //$categories = get_categories($profile->type)->slice(0, 7);

        return view('frontend.index', compact('banners', 'profiles', 'icons'));
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

    public function about() 
    {
        return view('frontend.about');
    }

    public function feedback() 
    {
        return view('frontend.feedback');
    }
}
