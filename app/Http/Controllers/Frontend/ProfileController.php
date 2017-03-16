<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Backend\Category;
use App\Models\Backend\Profile;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

use Flash;

/**
 * Class FrontendController.
 */
class ProfileController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
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
