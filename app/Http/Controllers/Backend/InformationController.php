<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\InformationDataTable;
use App\Http\Requests\Backend;
use App\Http\Requests\Backend\CreateInformationRequest;
use App\Http\Requests\Backend\UpdateInformationRequest;
use App\Repositories\Backend\InformationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class InformationController extends AppBaseController
{
    /** @var  InformationRepository */
    private $informationRepository;

    public function __construct(InformationRepository $informationRepo)
    {
        $this->informationRepository = $informationRepo;
    }

    /**
     * Display a listing of the Information.
     *
     * @param InformationDataTable $informationDataTable
     * @return Response
     */
    public function index(InformationDataTable $informationDataTable)
    {
        return $informationDataTable->render('backend.information.index');
    }

    /**
     * Show the form for creating a new Information.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.information.create');
    }

    /**
     * Store a newly created Information in storage.
     *
     * @param CreateInformationRequest $request
     *
     * @return Response
     */
    public function store(CreateInformationRequest $request)
    {
        $input = $request->all();

        $path = upload($request, 'pic_url');
        $input['pic_url'] = $path;
        //$input['view_count'] = 0;

        $information = $this->informationRepository->create($input);

        Flash::success('Information saved successfully.');

        return redirect(route('admin.information.index'));
    }

    /**
     * Display the specified Information.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            Flash::error('Information not found');

            return redirect(route('admin.information.index'));
        }

        return view('backend.information.show')->with('information', $information);
    }

    /**
     * Show the form for editing the specified Information.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            Flash::error('Information not found');

            return redirect(route('admin.information.index'));
        }

        return view('backend.information.edit')->with('information', $information);
    }

    /**
     * Update the specified Information in storage.
     *
     * @param  int              $id
     * @param UpdateInformationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInformationRequest $request)
    {
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            Flash::error('Information not found');

            return redirect(route('admin.information.index'));
        }
        $input = $request->all();

        if($request->file('pic_url')) {
            $path = upload($request, 'pic_url');
            $input['pic_url'] = $path;
        }
        else {
            unset($input['pic_url']);
        }

        $information = $this->informationRepository->update($input, $id);

        Flash::success('Information updated successfully.');

        return redirect(route('admin.information.index'));
    }

    /**
     * Remove the specified Information from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            Flash::error('Information not found');

            return redirect(route('admin.information.index'));
        }

        $this->informationRepository->delete($id);

        Flash::success('Information deleted successfully.');

        return redirect(route('admin.information.index'));
    }
}
