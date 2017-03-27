<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateIconRequest;
use App\Http\Requests\Backend\UpdateIconRequest;
use App\Repositories\Backend\IconRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IconController extends AppBaseController
{
    /** @var  IconRepository */
    private $iconRepository;

    public function __construct(IconRepository $iconRepo)
    {
        $this->iconRepository = $iconRepo;
    }

    /**
     * Display a listing of the Icon.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->iconRepository->pushCriteria(new RequestCriteria($request));
        //$icons = $this->iconRepository->all();
        $icons = $this->iconRepository->getTypeIcons($request->input('type', 3));

        return view('backend.icons.index')
            ->with('icons', $icons);
    }

    /**
     * Show the form for creating a new Icon.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.icons.create');
    }

    /**
     * Store a newly created Icon in storage.
     *
     * @param CreateIconRequest $request
     *
     * @return Response
     */
    public function store(CreateIconRequest $request)
    {
        $input = $request->all();

        $icon = $this->iconRepository->create($input);

        Flash::success('Icon saved successfully.');

        return redirect(route('admin.icons.index'));
    }

    /**
     * Display the specified Icon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $icon = $this->iconRepository->findWithoutFail($id);

        if (empty($icon)) {
            Flash::error('Icon not found');

            return redirect(route('admin.icons.index'));
        }

        return view('backend.icons.show')->with('icon', $icon);
    }

    /**
     * Show the form for editing the specified Icon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $icon = $this->iconRepository->findWithoutFail($id);

        if (empty($icon)) {
            Flash::error('Icon not found');

            return redirect(route('admin.icons.index'));
        }

        return view('backend.icons.edit')->with('icon', $icon);
    }

    /**
     * Update the specified Icon in storage.
     *
     * @param  int              $id
     * @param UpdateIconRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIconRequest $request)
    {
        $icon = $this->iconRepository->findWithoutFail($id);

        if (empty($icon)) {
            Flash::error('Icon not found');

            return redirect(route('admin.icons.index'));
        }

        $icon = $this->iconRepository->update($request->all(), $id);

        Flash::success('Icon updated successfully.');

        return redirect(route('admin.icons.index'));
    }

    /**
     * Remove the specified Icon from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $icon = $this->iconRepository->findWithoutFail($id);

        if (empty($icon)) {
            Flash::error('Icon not found');

            return redirect(route('admin.icons.index'));
        }

        $this->iconRepository->delete($id);

        Flash::success('Icon deleted successfully.');

        return redirect(route('admin.icons.index'));
    }
}
