<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Repositories\Frontend\Access\User\UserRepository;

use App\Models\Access\User\User;
use App\Models\Backend\Category;
use App\Models\Backend\Profile;
use App\Models\Backend\Industry;
use Illuminate\Http\Request;

use Flash;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        // Where to redirect users after registering
        $this->redirectTo = route('frontend.index');

        $this->user = $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        $data = $request->all();

        $verify_time = session('verify_time');
        $verify_code = session('verify_code');

        $step = $request->input('step');
        $phone = $request->input('phone');
        if($step == 2) {
            $verify_phone = session('phone');
            if($verify_phone != $phone) {
                Flash::error('验证码错误');
                return redirect()->back()->withInput()->with('error', '验证码错误');
            }
            if(!$verify_time) {
                Flash::error('请先获取短信');
                return redirect()->back()->withInput()->with('error', '验证码错误');
            }
            if($verify_time && time() - $verify_time > 30000) {
                Flash::error('短信验证超时.');
                return redirect()->back()->withInput()->with('error', '验证码错误');
            }
            if($verify_code != $request->input('verify_code')) {
                Flash::error('验证码错误.');
                return redirect()->back()->withInput()->with('error', '验证码错误');
            }
            if($phone) {
                $user = User::where('phone', $request->input('phone'))->first();
                if($user) {
                    Flash::success('手机号码已经存在.');
                    return redirect()->back()->withInput()->with('error', '手机号码已经存在');
                }
            }
        }

        $verify_code = $request->input('verify_code');
        $password = $request->input('password');
        $type = $request->input('type');
        $checked = $request->input('checked');
        $manufa_1 = $request->input('manufa_1');
        $manufa_2 = $request->input('manufa_2');

        $category_ids = $request->input('category_ids');
        $category_ids_array = explode('|', $category_ids);

        $province_city_name = $request->input('province_city_name');
        $province_city = $request->input('province_city');
        $industry_name = $request->input('industry_name');
        
        $name = $request->input('name');

        $step = $request->input('step')?$request->input('step'):1;

        if($step == 3) {
            $categories = Category::where('type', $type)
                ->where('parent_id', $manufa_1)
                ->get();
        }
        else {
            $categories = Category::where('type', $type)
                ->where('parent_id', 0)
                ->get();
        }

        $invite_code = $request->input('invite_code');
        if($invite_code) {
            $profile = Profile::where('invite_code', $invite_code)->first();
            if($profile) {
                $profile->invite_count ++;
                $profile->recommand_count ++;
                $profile->save();
            }
        }

        return view('frontend.auth.register', compact('step', 'data', 'phone', 'verify_code', 'password', 'type', 'checked', 'manufa_1', 'manufa_2', 'province_city_name', 'province_city', 'industry_name', 'name', 'categories', 'category_ids', 'category_ids_array', 'invite_code'));
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        if (config('access.users.confirm_email')) {
            $user = $this->user->create($request->all());
            event(new UserRegistered($user));

            return redirect($this->redirectPath())->withFlashSuccess(trans('exceptions.frontend.auth.confirmation.created_confirm'));
        } else {
            //todo: verify code

            $verify_time = session('verify_time');
            $verify_code = session('verify_code');

            if($verify_time && time() - $verify_time > 30000) {
                Flash::success('短信验证超时.');
                return redirect()->back()->withInput()->with('error', '验证码错误');
            }
            if($verify_code != $request->input('verify_code')) {
                Flash::success('验证码错误.');
                return redirect()->back()->withInput()->with('error', '验证码错误');
            }

            $user = User::where('phone', $request->input('phone'))->first();
            if($user) {
                Flash::success('手机号码已经存在.');
                return redirect()->back()->withInput()->with('error', '手机号码已经存在');
            }

            $data = array(
                'name' => $request->input('name'),
                'password' => $request->input('password'),
                'phone' => $request->input('phone')
            );

            $province_city = province_city($request->input('province_city'));
            $user = $this->user->create($data);

            if($request->input('manufa_2')) {
                $category_id = $request->input('manufa_2');
            }else {
                $category_id = $request->input('manufa_1');
            }

            if(!$category_id) {
                return redirect()->back()->withInput()->with('error', '请选择职业类型');
            }

            $profile_data = array(
                'prov_id' => $province_city['prov_id'],
                'city_id' => $province_city['city_id'],
                'area_id' => $province_city['area_id'],
                'type' => $request->input('type'),
                'industry_id' => 0,
                'industry_name' => $request->input('industry_name'),
                'category_id' => $category_id,
                'category_ids' => '|'.$request->input('category_ids').'|',
                'user_id' => $user->id,
                'service' => '',
                'avatar' => '/image/avatar.png',
                'identity_urls' => ''
            );
            $profile = Profile::create($profile_data);

            $profile->invite_code  = $profile->id + 100000;
            $profile->save();

            $industry_data = array(
                'display_name' => $request->input('industry_name'),
                'avatar' => '/image/avatar.png',
                'user_id' => $user->id,
                'prov_id' => $province_city['prov_id'],
                'city_id' => $province_city['city_id'],
                'area_id' => $province_city['area_id'],
                'address' => '',
                'service' => '',
                'description' => ''
            );
            $industry_data['display_name'] = $industry_data['display_name']?$industry_data['display_name']: ' ';
            $industry = Industry::create($industry_data);

            access()->login($user);
            event(new UserRegistered(access()->user()));

            Flash::success('注册成功.');
            if($profile->type == 3) {
                return redirect($this->redirectPath());
            }
            return redirect(route('frontend.industries.edit'));
        }
    }
}
