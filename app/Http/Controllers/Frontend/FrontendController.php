<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;

use App\Models\Backend\Icon;
use App\Models\Backend\Banner;
use App\Models\Backend\Score;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Backend\Industry;
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
        $profile = Profile::where('user_id', access()->user()->id)->first();
        $from = '';

        $banners = Banner::whereIn('type', array(0, $profile->type))
			->get();

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
            $from = 'agent';
            break;
        //经销商看经销商，厂商
        case \App\Models\Backend\Category::TYPE_AGENT:
            $type = array(
                \App\Models\Backend\Category::TYPE_AGENT,
                \App\Models\Backend\Category::TYPE_MANUFACTURER
            );
            break;
        case \App\Models\Backend\Category::TYPE_MANUFACTURER:
        //厂商看厂商
            $type = array(\App\Models\Backend\Category::TYPE_MANUFACTURER);
            $from = 'manufacturer';
            break;
        default:
            $type = array(
                \App\Models\Backend\Category::TYPE_USER,
                \App\Models\Backend\Category::TYPE_AGENT,
                \App\Models\Backend\Category::TYPE_MANUFACTURER
            );
            break;
        }
        $profiles = Profile::where('is_recommand', 1)
            ->whereIn('type', $type)
            ->orderBy('updated_at', 'desc')
            ->orderBy('recommand_count', 'desc')
            ->limit(20)
            ->get();
        
        $products = Product::orderBy('updated_at', 'desc')
            ->where('is_recommand', 1)
            ->limit(6)
            ->get();

        $products = $products->chunk(3);
        
        $gb2260 = new \GB2260\GB2260();
        foreach($profiles as $profile) {
            province_city_name($profile);
            $profile->user = User::find($profile->user_id);
            $profile->industry_service = Industry::select('service')->where('user_id', $profile->user_id)->first()->service;
        }

        //$categories = get_categories($profile->type)->slice(0, 7);
#dd($icons->toArray());

        return view('frontend.index', compact('banners', 'profiles', 'icons', 'from', 'products'));
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

    public function success() 
    {
		$profile = Profile::where('user_id', access()->user()->id)->first();
		
        return view('frontend.success', compact('profile'));
    }

    public function forget(Request $request) 
    {
        $step = $request->input('step', 1);
        return view('frontend.forget', compact('step'));
    }

    public function token() {
        $auth = new \Qiniu\Auth(env('QINIU_AK'), env('QINIU_SK'));
        $token = $auth->uploadToken(env('QINIU_BK'));
        return json_encode(['uptoken'=>$token]);
    }

    public function share(Request $request) {
		$invite_code = $request->input('invite_code');
		if(!$invite_code) {
			return redirect('/');
		}
		$profile = Profile::where('invite_code', $invite_code)->first();
        #$profile = Profile::where('user_id', access()->user()->id)->first();
        if(!$profile) {
            return redirect()->back();
        }
        $invite_code = $profile->invite_code;
        return view('frontend.share', compact('invite_code'));
    }

    public function shareRegister(Request $request) {
        $banners = Banner::where('type', Banner::TYPE_SHARE_REGISTER)->get();

        $invite_code = $request->input('invite_code');
        if(!$invite_code) {
            //todo
        }
        $profile = Profile::where('invite_code', $invite_code)->first();

        return view('frontend.share-register', compact('banners', 'invite_code'));
    }

}
