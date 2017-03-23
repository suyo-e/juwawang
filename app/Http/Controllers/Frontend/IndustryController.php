<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Backend\Category;
use App\Models\Access\User\User;
use App\Models\Backend\Profile;
use App\Models\Backend\Industry;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

use Flash;

/**
 * Class FrontendController.
 */
class IndustryController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $display_name = $request->input('display_name');
        $category_id = $request->input('category_id');
        $time = $request->input('time');

        $gb2260 = new \GB2260\GB2260();
        $industries = new Industry;
        if($display_name) {
            $industries = $industries->where('display_name', 'LIKE', "%$display_name%");
        }
        if($category_id) {
            $user_ids = Profile::where('category_id', $category_id)->pluck('user_id');
            $industries = $industries->whereIn('user_id', $user_ids);
        }
        $industries = $industries->get();

        foreach($industries as $industry) {
            $industry->user = User::find($industry->user_id);
            $city = $gb2260->get($industry->city_id); 
            $city = explode(" ", $city)[0];
            $province = $gb2260->get($industry->prov_id); 
            
            $industry->province_city_name = "$province $city";
            $industry->province_city = $industry->prov_id."," .$industry->city_id;

            $industry->profile = Profile::where('user_id', $industry->user_id)->first();
        }

        $profile = Profile::where('user_id', access()->user()->id)->first();
        $categories = get_categories($profile->type);
        return view('frontend.industries.index', compact('industries', 'display_name', 'categories', 'time', 'category_id'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $gb2260 = new \GB2260\GB2260();
        $user = access()->user();
        $industry = Industry::where('user_id', $user->id)->first();
        if(!$industry) {
            $industry = new Industry;
            $industry->avatar = '/image/Sbj.png';
        }
        
        $city = $gb2260->get($industry->city_id); 
        $city = explode(" ", $city)[0];
        $province = $gb2260->get($industry->prov_id); 
        
        $industry->province_city_name = "$province $city";
        $industry->province_city = $industry->prov_id."," .$industry->city_id;

        $identity_urls = json_decode($industry->identity_urls);
        if(!isset($identity_urls[0])) {
            $identity_urls[0] = "/image/zhaopian.png";
        }

        return view('frontend.industries.edit', compact('industry', 'user', 'identity_urls'));
    }

    public function show(Request $request) 
    {
        $gb2260 = new \GB2260\GB2260();
        $user_id = $request->input('user_id');
        if(!$user_id) {
            $user_id = access()->user()->id;
        }
        $industry = Industry::where('user_id', $user_id)->first();
        $profile = Profile::where('user_id', $user_id)->first();
        $user = User::find($user_id);
        
        $city = $gb2260->get($industry->city_id); 
        $city = explode(" ", $city)[0];
        $province = $gb2260->get($industry->prov_id); 
        
        $industry->province_city_name = "$province $city";
        $industry->province_city = $industry->prov_id."," .$industry->city_id;

        return view('frontend.industries.show', compact('industry', 'user', 'profile'));
    }

    public function update(Request $request) {
        $user = access()->user();
        $industry = Industry::where('user_id', $user->id)->first();
        $profile = Profile::where('user_id', $user->id)->first();

        $industry->display_name = $profile->industry_name?$profile->industry_name: '';
        $industry->avatar = $request->input('avatar');
        if($request->input('province_city')) {
            $province_city = explode(',', $request->input('province_city'));
            $industry->prov_id = $province_city[0];
            $industry->city_id = $province_city[1];
        }
        $industry->address = $request->input('address');
        $industry->service = $request->input('service');
        $industry->description = $request->input('description');

        $industry->pic_urls = '';
        $industry->identity_urls = json_encode(array($request->input('identity_url')));

        $industry->save();

        return redirect(route('frontend.user'));
    }
}
