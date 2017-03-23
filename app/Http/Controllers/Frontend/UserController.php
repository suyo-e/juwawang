<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Access\User\User;
use App\Models\Backend\Profile;
use App\Models\Backend\Category;
use App\Models\Backend\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Flash;

/**
 * Class FrontendController.
 */
class UserController extends Controller
{
    public function password() {
        return view('frontend.user.password');
    }

    public function show(Request $request) 
    {
        $user_id = $request->input('user_id');
        if(!$user_id) {
            $user_id = access()->user()->id;
        }
        $user = User::find($user_id);
        $profile = Profile::where('user_id', $user_id)->first();

        return view('frontend.user.show', compact('user', 'profile'));
    }

    public function edit(Request $request) 
    {
        $user_id = $request->input('user_id');
        if(!$user_id) {
            $user_id = access()->user()->id;
        }
        $user = User::find($user_id);

        $profile = Profile::where('user_id', $user->id)->first();
        
        try {
            $gb2260 = new \GB2260\GB2260();
            $city = $gb2260->get($profile->city_id); 
            $city = explode(" ", $city)[0];
            $province = $gb2260->get($profile->prov_id); 
            
            $profile->province_city_name = "$province $city";
            $profile->province_city = $profile->prov_id."," .$profile->city_id;
            $profile->category_name = Category::find($profile->category_id)->display_name;
        } catch (\Exception $e) {
        }


        return view('frontend.user.edit', compact('user', 'profile'));
    }

    public function update(Request $request) 
    {
        //$user_id = $request->input('user_id');
        //if(!$user_id) {
        $user_id = access()->user()->id;
        //}
        $user = User::find($user_id);
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');

        if($old_password && $new_password) {
            if(Hash::check($old_password, $user->password)) {
                $user->password = bcrypt($new_password);
            }
        }

        $profile = Profile::where('user_id', $user->id)->first();
        $industry = Industry::where('user_id', $user->id)->first();

        if($request->input('avatar')) {
            $profile->avatar = $request->input('avatar');
        }
        if($request->input('name')) {
            $user->name = $request->input('name');
        }
        if($request->input('province_city')) {
            $province_city = province_city($request->input('province_city'));
            $profile->prov_id = $province_city['prov_id'];
            $profile->city_id = $province_city['city_id'];
            $profile->area_id = $province_city['area_id'];

            $industry->prov_id = $province_city['prov_id'];
            $industry->city_id = $province_city['city_id'];
            $industry->area_id = $province_city['area_id'];
        }
        if($request->input('service')) {
            $profile->service = $request->input('service');
        }
        $profile->sex = $request->input('sex');

        if($request->input('industry_name')) {
            $industry->display_name = $request->input('industry_name');
        }

        $industry->save();
        $profile->save();
        $user->save();

        Flash::success('修改成功');

        return redirect(route('frontend.user'));
    }

    public function login()
    {
        return view('frontend.user.login');
    }

    public function register() 
    {
        return view('frontend.user.register');
    }

    public function postLogin() 
    {
        dd(1);
    }

    public function postRegister() 
    {
        dd(1);
    }
}
