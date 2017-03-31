<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;

/**
 * Class UserTableController.
 */
class UserTableController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageUserRequest $request)
    {
        return Datatables::of($this->users->getForDataTable($request->get('status'), $request->get('trashed')))
            ->escapeColumns(['name', 'email'])
            ->editColumn('confirmed', function ($user) {
                return $user->confirmed_label;
            })
            ->addColumn('province_city_name', function($user) {
                $profile = \App\Models\Backend\Profile::where('user_id', $user->id)->first();
                if($profile) {
                    $profile = province_city_name($profile);
                    return $profile->province_city_name;
                }
                     
                return '';
            })
            ->addColumn('avatar', function($user) {
                $profile = \App\Models\Backend\Profile::where('user_id', $user->id)->first();
                if($profile)
                    return '<img src="'.$profile->avatar.'" height="50" />';
                return '';
            })
            ->addColumn('type', function($user) {
                $profile = \App\Models\Backend\Profile::where('user_id', $user->id)->first();
                if(!$profile)
                    return '';

                switch($profile->type) {
                case 1:
                    return '厂商';
                case 2:
                    return '经销商';
                case 3:
                    return '普通用户';
                default:
                    return '';
                }
            })
            ->addColumn('roles', function ($user) {
                return $user->roles->count() ?
                    implode('<br/>', $user->roles->pluck('name')->toArray()) :
                    trans('labels.general.none');
            })
            ->addColumn('actions', function ($user) {
                return $user->action_buttons;
            })
            ->withTrashed()
            ->make(true);
    }
}
