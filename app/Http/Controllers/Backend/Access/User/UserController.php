<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Access\Role\RoleRepository;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Requests\Backend\Access\User\StoreUserRequest;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserRequest;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * @param UserRepository $users
     * @param RoleRepository $roles
     */
    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {
        return view('backend.access.index');
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request)
    {
        return view('backend.access.create')
            ->withRoles($this->roles->getAll());
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->create(['data' => $request->except('assignees_roles'), 'roles' => $request->only('assignees_roles')]);

        return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function show(User $user, ManageUserRequest $request)
    {
        return view('backend.access.show')
            ->withUser($user);
    }

    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function edit(User $user, ManageUserRequest $request)
    {
        $profile=\App\Models\Backend\Profile::where('user_id', $user->id)->first();
        return view('backend.access.edit')
            ->withUser($user)
            ->withProfile($profile)
            ->withUserRoles($user->roles->pluck('id')->all())
            ->withRoles($this->roles->getAll());
    }

    /**
     * @param User              $user
     * @param UpdateUserRequest $request
     *
     * @return mixed
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $this->users->update($user, ['data' => $request->except('assignees_roles'), 'roles' => $request->only('assignees_roles')]);
        $profile=\App\Models\Backend\Profile::where('user_id', $user->id)->first();
        $profile->avatar = request('avatar');
        $profile->save();

        return redirect()->back();
        //return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function destroy(User $user, ManageUserRequest $request)
    {
        $this->users->delete($user);

        return redirect()->route('admin.access.user.deleted')->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }

    public function profile() {
        $user = access()->user();
        $profile=\App\Models\Backend\Profile::where('user_id', $user->id)->first();
        return view('backend.access.edit')
            ->withUser($user)
            ->withProfile($profile)
            ->withUserRoles($user->roles->pluck('id')->all())
            ->withRoles($this->roles->getAll());
    }

    public function industry() {
        $industry = \App\Models\Backend\Industry::where('user_id', access()->user()->id)->first();

        if (empty($industry)) {
            return redirect()->route('admin.industries.index')->withFlashError('商户不存在');
        }
        $industry = province_city_name($industry);

        return view('backend.industries.edit')->with('industry', $industry);
    }
}
