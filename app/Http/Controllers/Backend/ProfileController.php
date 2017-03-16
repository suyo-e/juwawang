<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\ProfileDataTable;
use App\Http\Requests\Backend;
use App\Http\Requests\Backend\CreateProfileRequest;
use App\Http\Requests\Backend\UpdateProfileRequest;
use App\Repositories\Backend\ProfileRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProfileController extends AppBaseController
{
    /** @var  ProfileRepository */
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the Profile.
     *
     * @param ProfileDataTable $profileDataTable
     * @return Response
     */
    public function index(ProfileDataTable $profileDataTable)
    {
        return $profileDataTable->render('backend.profiles.index');
    }

    /**
     * Show the form for creating a new Profile.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.profiles.create');
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param CreateProfileRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        $input = $request->all();

        $profile = $this->profileRepository->create($input);

        Flash::success('Profile saved successfully.');

        return redirect(route('admin.profiles.index'));
    }

    /**
     * Display the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('admin.profiles.index'));
        }

        return view('backend.profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('admin.profiles.index'));
        }

        return view('backend.profiles.edit')->with('profile', $profile);
    }

    /**
     * Update the specified Profile in storage.
     *
     * @param  int              $id
     * @param UpdateProfileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileRequest $request)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('admin.profiles.index'));
        }
        $input = $request->all();
        if(!isset($input['identity_urls']))
            $input['identity_urls'] = '';

        $profile = $this->profileRepository->update($input, $id);

        Flash::success('Profile updated successfully.');

        return redirect(route('admin.profiles.index'));
    }

    /**
     * Remove the specified Profile from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('admin.profiles.index'));
        }

        $this->profileRepository->delete($id);

        Flash::success('Profile deleted successfully.');

        return redirect(route('admin.profiles.index'));
    }
}
