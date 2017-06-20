<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\ScoreDataTable;
use App\Http\Requests\Backend;
use App\Http\Requests\Backend\CreateScoreRequest;
use App\Http\Requests\Backend\UpdateScoreRequest;
use App\Repositories\Backend\ScoreRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ScoreController extends AppBaseController
{
    /** @var  ScoreRepository */
    private $scoreRepository;

    public function __construct(ScoreRepository $scoreRepo)
    {
        $this->scoreRepository = $scoreRepo;
    }

    /**
     * Display a listing of the Score.
     *
     * @param ScoreDataTable $scoreDataTable
     * @return Response
     */
    public function index(ScoreDataTable $scoreDataTable)
    {
        return $scoreDataTable->render('backend.scores.index');
    }

    /**
     * Show the form for creating a new Score.
     *
     * @return Response
     */
    public function create()
    {
        if(!access()->hasRole('Administrator')) 
            return redirect()->back();
        return view('backend.scores.create');
    }

    /**
     * Store a newly created Score in storage.
     *
     * @param CreateScoreRequest $request
     *
     * @return Response
     */
    public function store(CreateScoreRequest $request)
    {
        if(!access()->hasRole('Administrator')) 
            return redirect()->back();
        $input = $request->all();

        $profile = \App\Models\Backend\Profile::where('user_id', $input['user_id'])->first();
        if(!$profile) {
            Flash::error('用户信息不存在');
            return redirect()->back();
        }

        $input['current_amount'] = $profile->current_amount = $profile->current_amount + $input['amount'];
        if($input['amount'] > 0) {
            $profile->total_amount = $profile->total_amount + $input['amount'];
        }
        $input['total_amount'] = $profile->total_amount;
        $profile->save();

        $score = $this->scoreRepository->create($input);

        Flash::success('Score saved successfully.');

        return redirect(route('admin.scores.index'));
    }

    /**
     * Display the specified Score.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(!access()->hasRole('Administrator')) 
            return redirect()->back();
        $score = $this->scoreRepository->findWithoutFail($id);

        if (empty($score)) {
            Flash::error('Score not found');

            return redirect(route('admin.scores.index'));
        }

        return view('backend.scores.show')->with('score', $score);
    }

    /**
     * Show the form for editing the specified Score.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(!access()->hasRole('Administrator')) 
            return redirect()->back();
        $score = $this->scoreRepository->findWithoutFail($id);

        if (empty($score)) {
            Flash::error('Score not found');

            return redirect(route('admin.scores.index'));
        }

        return view('backend.scores.edit')->with('score', $score);
    }

    /**
     * Update the specified Score in storage.
     *
     * @param  int              $id
     * @param UpdateScoreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateScoreRequest $request)
    {
        if(!access()->hasRole('Administrator')) 
            return redirect()->back();
        $score = $this->scoreRepository->findWithoutFail($id);

        if (empty($score)) {
            Flash::error('Score not found');

            return redirect(route('admin.scores.index'));
        }

        $score = $this->scoreRepository->update($request->all(), $id);

        Flash::success('Score updated successfully.');

        return redirect(route('admin.scores.index'));
    }

    /**
     * Remove the specified Score from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if(!access()->hasRole('Administrator')) 
            return redirect()->back();
        $score = $this->scoreRepository->findWithoutFail($id);

        if (empty($score)) {
            Flash::error('Score not found');

            return redirect(route('admin.scores.index'));
        }

        $this->scoreRepository->delete($id);

        Flash::success('Score deleted successfully.');

        return redirect(route('admin.scores.index'));
    }
}
