<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\CollectDataTable;
use App\Http\Requests\Backend;
use App\Http\Requests\Backend\CreateCollectRequest;
use App\Http\Requests\Backend\UpdateCollectRequest;
use App\Repositories\Backend\CollectRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CollectController extends AppBaseController
{
    /** @var  CollectRepository */
    private $collectRepository;

    public function __construct(CollectRepository $collectRepo)
    {
        $this->collectRepository = $collectRepo;
    }

    /**
     * Display a listing of the Collect.
     *
     * @param CollectDataTable $collectDataTable
     * @return Response
     */
    public function index(CollectDataTable $collectDataTable)
    {
        return $collectDataTable->render('backend.collects.index');
    }

    /**
     * Show the form for creating a new Collect.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.collects.create');
    }

    /**
     * Store a newly created Collect in storage.
     *
     * @param CreateCollectRequest $request
     *
     * @return Response
     */
    public function store(CreateCollectRequest $request)
    {
        $input = $request->all();

        $collect = $this->collectRepository->create($input);

        Flash::success('Collect saved successfully.');

        return redirect(route('admin.collects.index'));
    }

    /**
     * Display the specified Collect.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $collect = $this->collectRepository->findWithoutFail($id);

        if (empty($collect)) {
            Flash::error('Collect not found');

            return redirect(route('admin.collects.index'));
        }

        return view('backend.collects.show')->with('collect', $collect);
    }

    /**
     * Show the form for editing the specified Collect.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $collect = $this->collectRepository->findWithoutFail($id);

        if (empty($collect)) {
            Flash::error('Collect not found');

            return redirect(route('admin.collects.index'));
        }

        return view('backend.collects.edit')->with('collect', $collect);
    }

    /**
     * Update the specified Collect in storage.
     *
     * @param  int              $id
     * @param UpdateCollectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCollectRequest $request)
    {
        $collect = $this->collectRepository->findWithoutFail($id);

        if (empty($collect)) {
            Flash::error('Collect not found');

            return redirect(route('admin.collects.index'));
        }

        $collect = $this->collectRepository->update($request->all(), $id);

        Flash::success('Collect updated successfully.');

        return redirect(route('admin.collects.index'));
    }

    /**
     * Remove the specified Collect from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $collect = $this->collectRepository->findWithoutFail($id);

        if (empty($collect)) {
            Flash::error('Collect not found');

            return redirect(route('admin.collects.index'));
        }

        $this->collectRepository->delete($id);

        Flash::success('Collect deleted successfully.');

        return redirect(route('admin.collects.index'));
    }
}
