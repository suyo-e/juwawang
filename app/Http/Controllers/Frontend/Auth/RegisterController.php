<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Repositories\Frontend\Access\User\UserRepository;

use App\Models\Backend\Category;
use App\Models\Backend\Profile;
use App\Models\Backend\Industry;

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
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
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
                'user_id' => $user->id,
                'service' => '',
                'identity_urls' => ''
            );
            $profile = Profile::create($profile_data);

            $industry_data = array(
                'display_name' => $request->input('industry_name'),
                'avatar' => '',
                'user_id' => $user->id,
                'prov_id' => $province_city['prov_id'],
                'city_id' => $province_city['city_id'],
                'address' => '',
                'service' => '',
                'description' => ''
            );
            $industry = Industry::create($industry_data);

            access()->login($user);
            event(new UserRegistered(access()->user()));

            Flash::success('注册成功.');
            return redirect($this->redirectPath());
        }
    }
}
