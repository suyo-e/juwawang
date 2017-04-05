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
        $category_ids = $request->input('category_ids');
        $from = $request->input('from');
        $time = $request->input('time');

        $profile = Profile::where('user_id', access()->user()->id)->first();

        switch($from) {
        case 'user':
            $profile_type = Category::TYPE_USER;
            //$user_ids = Profile::where('type', Category::TYPE_USER)->pluck('user_id');
            break;
        case 'agent':
            $profile_type = Category::TYPE_AGENT;
            //$user_ids = Profile::where('type', Category::TYPE_AGENT)->pluck('user_id');
            break;
        case 'manufacturer':
            $profile_type = Category::TYPE_MANUFACTURER;
            //$user_ids = Profile::where('type', Category::TYPE_MANUFACTURER)->pluck('user_id');
            break;
        default:
            $profile_type = get_profile_types($profile->type)[0];
            /*
            $profile_type = array(
                Category::TYPE_MANUFACTURER,
                Category::TYPE_AGENT,
                Category::TYPE_USER
            );
             */
            break;
        }

        $categories = get_categories($profile_type);

        if(!is_profile_type_permission($profile->type, $profile_type)) {
            $industries = array();
            $profiles = array();
            return view('frontend.industries.index', compact('industries', 'display_name', 'categories', 'time', 'category_id', 'profile_type', 'from', 'category_ids'));
        }
        /*
        if(!isset($profile_type)) {
            $profile = Profile::where('user_id', access()->user()->id)->first();
            $profile_type = $profile->type;
        }
         */

        $industries = new Industry;
        if($display_name) {
            $industries = $industries->where('display_name', 'LIKE', "%$display_name%");
        }

        $profiles = Profile::select('user_id');
        if($category_id) {
            $profiles = $profiles->where('category_ids', 'LIKE', "%$category_id|%");
        }
        elseif($category_ids) {
            $ids = explode("|", $category_ids);

            $profiles = $profiles->where(function($query) use ($ids) {
                foreach($ids as $cid) {
                    $query->orWhere('category_ids', 'LIKE', "%$cid|%");
                }
            });
        }
        if($profile_type) {
            $profiles = $profiles->where('type', $profile_type);
        }
        $user_ids = $profiles->pluck('user_id');

        $industries = $industries->whereIn('user_id', $user_ids);
        
        $industries = $industries->get();

        foreach($industries as $industry) {
            $industry->user = User::find($industry->user_id);
            province_city_name($industry);

            $industry->profile = Profile::where('user_id', $industry->user_id)->first();
            province_city_name($industry->profile);
        }

        return view('frontend.industries.index', compact('industries', 'display_name', 'categories', 'time', 'category_id', 'profile_type', 'from', 'category_ids', 'profile'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = access()->user();
        $industry = Industry::where('user_id', $user->id)->first();
        if(!$industry) {
            $industry = new Industry;
            $industry->avatar = '/image/Sbj.png';
        }
        
        $industry = province_city_name($industry);

        $identity_urls = json_decode($industry->identity_urls);
        if(!isset($identity_urls[0])) {
            $identity_urls[0] = "/image/zhaopian.png";
        }

        return view('frontend.industries.edit', compact('industry', 'user', 'identity_urls'));
    }

    public function show(Request $request) 
    {
        $user_id = $request->input('user_id');
        if(!$user_id) {
            $user_id = access()->user()->id;
        }
        $industry = Industry::where('user_id', $user_id)->first();
        $profile = Profile::where('user_id', $user_id)->first();
        $user = User::find($user_id);
        
        $industry = province_city_name($industry);

        return view('frontend.industries.show', compact('industry', 'user', 'profile'));
    }

    public function update(Request $request) {
        $user = access()->user();
        $industry = Industry::where('user_id', $user->id)->first();
        $profile = Profile::where('user_id', $user->id)->first();

        $industry->display_name = $profile->industry_name?$profile->industry_name: '';


        if($request->input('avatar')) {
            $industry->avatar = $request->input('avatar');
        }

        if($request->input('province_city')) {
            $province_city = province_city($request->input('province_city'));
            $industry->prov_id = $province_city['prov_id'];
            $industry->city_id = $province_city['city_id'];
            $industry->area_id = $province_city['area_id'];
            
/*
            $province_city = explode(',', $request->input('province_city'));
            $industry->prov_id = $province_city[0];
            $industry->city_id = $province_city[1];
*/
        }
        $industry->address = $request->input('address');
        $industry->service = $request->input('service');
        $industry->description = $request->input('description');

        $industry->qq = $request->input('qq');
        $industry->wechat = $request->input('wechat');
        $industry->phone = $request->input('phone');

        $industry->pic_urls = '';
        $industry->identity_urls = json_encode(array($request->input('identity_url')));

        $industry->save();

        return redirect(route('frontend.user'));
    }
}
