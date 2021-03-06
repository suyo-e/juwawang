<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\IndustryDataTable;
use App\Http\Requests\Backend;
use App\Http\Requests\Backend\CreateIndustryRequest;
use App\Http\Requests\Backend\UpdateIndustryRequest;
use App\Repositories\Backend\IndustryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class IndustryController extends AppBaseController
{
    /** @var  IndustryRepository */
    private $industryRepository;

    public function __construct(IndustryRepository $industryRepo)
    {
        $this->industryRepository = $industryRepo;
    }

    /**
     * Display a listing of the Industry.
     *
     * @param IndustryDataTable $industryDataTable
     * @return Response
     */
    public function index(IndustryDataTable $industryDataTable)
    {
        return $industryDataTable->render('backend.industries.index');
    }

    /**
     * Show the form for creating a new Industry.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.industries.create');
    }

    /**
     * Store a newly created Industry in storage.
     *
     * @param CreateIndustryRequest $request
     *
     * @return Response
     */
    public function store(CreateIndustryRequest $request)
    {
        $input = $request->all();

        $industry = $this->industryRepository->create($input);

        Flash::success('Industry saved successfully.');

        return redirect(route('admin.industries.index'));
    }

    /**
     * Display the specified Industry.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $industry = $this->industryRepository->findWithoutFail($id);
        $industry->updated_at = date("Y-m-d H:i:s");
        $industry->save();

        $profile = \App\Models\Backend\Profile::where('user_id', $industry->user_id)->first();
        $profile->updated_at = date("Y-m-d H:i:s");
        $profile->save();
        return redirect(route('admin.industries.index'));
/*
        if (empty($industry)) {
            Flash::error('Industry not found');

            return redirect(route('admin.industries.index'));
        }

        return view('backend.industries.show')->with('industry', $industry);
 */
    }

    /**
     * Show the form for editing the specified Industry.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $industry = $this->industryRepository->findWithoutFail($id);

        if (empty($industry)) {
            Flash::error('Industry not found');

            return redirect(route('admin.industries.index'));
        }
        $industry = province_city_name($industry);

        return view('backend.industries.edit')->with('industry', $industry);
    }

    /**
     * Update the specified Industry in storage.
     *
     * @param  int              $id
     * @param UpdateIndustryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIndustryRequest $request)
    {
        $industry = $this->industryRepository->findWithoutFail($id);

        if (empty($industry)) {
            Flash::error('Industry not found');

            return redirect(route('admin.industries.index'));
        }

        //dd($request->all());
        $industry = $this->industryRepository->update($request->all(), $id);
        //dd($industry->toArray());

        Flash::success('Industry updated successfully.');

        $profile = \App\Models\Backend\Profile::where('user_id', $industry->user_id)->first();

        $is_admin = \App\Models\Backend\Profile::where('user_id', access()->user()->id)->first();
        if($is_admin) {
            return redirect()->back()->withFlashError('更新成功');
        }

        if($profile->type == \App\Models\Backend\Category::TYPE_USER) {
            return redirect(route('admin.industries.index', ['type'=>'user']));
        }
        else if($profile->type == \App\Models\Backend\Category::TYPE_AGENT) {
            return redirect(route('admin.industries.index', ['type'=>'agent']));
        }
        else if($profile->type == \App\Models\Backend\Category::TYPE_MANUFACTURER) {
            return redirect(route('admin.industries.index', ['type'=>'manufacturer']));
        }

        return redirect(route('admin.industries.index'));
    }

    /**
     * Remove the specified Industry from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $industry = $this->industryRepository->findWithoutFail($id);

        if (empty($industry)) {
            Flash::error('Industry not found');

            return redirect(route('admin.industries.index'));
        }

        $this->industryRepository->delete($id);

        Flash::success('Industry deleted successfully.');

        return redirect(route('admin.industries.index'));
    }
}
