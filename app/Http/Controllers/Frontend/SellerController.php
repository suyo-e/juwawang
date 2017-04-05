<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Backend\Category;
use App\Models\Backend\Profile;
use App\Models\Backend\Product;
use App\Models\Access\User\User;
use Illuminate\Http\Request;

use Flash;

/**
 * Class FrontendController.
 */
class SellerController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $profiles = Profile::where('type', '!=', 3)->get();
        foreach($profiles as $profile) {
            $profile->user = User::find($profile->user_id);

            $profile = province_city_name($profile);
        }

        return view('frontend.sellers.index', compact('profiles'));
    }

    public function show(Request $request) 
    {
        $user_id = $request->input('user_id');
        $industry_name = $request->input('industry_name');
        if(!$user_id) {
            $user_id = access()->user()->id;
        }
        $user = User::find($user_id);
        $profile = Profile::where('user_id', $user_id)->first();

        $profile->recommand_count = 0;
 
        $profile = province_city_name($profile);
        return view('frontend.sellers.show', compact('user', 'profile', 'industry_name'));
    }

    public function edit() 
    {
        $user_id = access()->user()->id;
        $user = User::find($user_id);
        $profile = Profile::where('user_id', $user_id)->first();

        $profile = province_city_name($profile);
        $profile->recommand_count = 0;
 
        return view('frontend.sellers.edit', compact('user', 'profile'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = access()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        return view('frontend.profiles.create', compact('profile', 'user'));
    }

    public function store(Request $request) {
        $user = access()->user();

        $realname = $request->input('realname');
        $identity_str = $request->input('identity_str');
        $identity_urls = json_encode($request->input('identity_urls'));

        if(!$realname) {
            Flash::error('请输入真实姓名');
            return redirect()->back();
        }
        if(!$identity_str) {
            Flash::error('请输入证件号');
            return redirect()->back();
        }
        $profile = Profile::where('user_id', $user->id)->first();
        if(!$profile) {
            $profile = new Profile;
            $profile->user_id = $user->id;
        }

        $profile->realname = $realname;
        $profile->identity_str = $identity_str;
        $profile->identity_urls = $identity_urls;

        $profile->save();
        return redirect()->back();
    }
}
