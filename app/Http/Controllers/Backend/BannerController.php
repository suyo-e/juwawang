<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\BannerDataTable;
use App\Http\Requests\Backend;
use App\Http\Requests\Backend\CreateBannerRequest;
use App\Http\Requests\Backend\UpdateBannerRequest;
use App\Repositories\Backend\BannerRepository;
use App\Models\Backend\Profile;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BannerController extends AppBaseController
{
    /** @var  BannerRepository */
    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepo)
    {
        $this->bannerRepository = $bannerRepo;
    }

    /**
     * Display a listing of the Banner.
     *
     * @param BannerDataTable $bannerDataTable
     * @return Response
     */
    public function index(BannerDataTable $bannerDataTable)
    {
        $category_ids = _get('category_ids');
        return $bannerDataTable->render('backend.banners.index', compact('category_ids'));
    }

    /**
     * Show the form for creating a new Banner.
     *
     * @return Response
     */
    public function create()
    {
        $category_ids = _get('category_ids');

        if($category_ids != '') {

            return view('backend.banners.create-recommand', compact('category_ids'));
        }

        return view('backend.banners.create', compact('category_ids'));
    }

    /**
     * Store a newly created Banner in storage.
     *
     * @param CreateBannerRequest $request
     *
     * @return Response
     */
    public function store(CreateBannerRequest $request)
    {
        $input = $request->all();
        if($request->file('pic_url')) {
            $path = upload($request, 'pic_url');
            $input['pic_url'] = $path;
        }


        $banner = $this->bannerRepository->create($input);

        Flash::success('Banner saved successfully.');

        if(!_is_banner_recommand($banner->type)) {
            $profile= Profile::find($banner->url);
            if(!$profile) {
                Flash::error('用户不存在');
                return redirect()->back();
            }
            return redirect(route('admin.banners.index', ['category_ids' => $banner->display_name]));
        }
        return redirect(route('admin.banners.index'));
    }

    /**
     * Display the specified Banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('admin.banners.index'));
        }

        return view('backend.banners.show')->with('banner', $banner);
    }

    /**
     * Show the form for editing the specified Banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('admin.banners.index'));
        }

        if(_is_banner_recommand($banner->type)) {
            return view('backend.banners.edit')->with('banner', $banner);
        }
        else {
            return view('backend.banners.edit-recommand')->with('banner', $banner)->with('category_ids', $banner->display_name);
        }
    }

    /**
     * Update the specified Banner in storage.
     *
     * @param  int              $id
     * @param UpdateBannerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBannerRequest $request)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('admin.banners.index'));
        }

        $input = $request->all();
        if($request->file('pic_url')) {
            $path = upload($request, 'pic_url');
            $input['pic_url'] = $path;
        }

        $banner = $this->bannerRepository->update($input, $id);

        Flash::success('Banner updated successfully.');

        if(!_is_banner_recommand($banner->type)) {
            $profile= Profile::where('user_id', $banner->url)->first();
            if(!$profile) {
                Flash::error('用户不存在');
                return redirect()->back();
            }
            return redirect(route('admin.banners.index', ['category_ids' => $banner->display_name]));
        }
        return redirect(route('admin.banners.index'));
    }

    /**
     * Remove the specified Banner from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('admin.banners.index'));
        }

        $this->bannerRepository->delete($id);

        Flash::success('Banner deleted successfully.');

        return redirect(route('admin.banners.index'));
    }
}
