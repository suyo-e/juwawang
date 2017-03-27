<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateCollectRequest;
use App\Http\Requests\Backend\UpdateCollectRequest;
use App\Repositories\Backend\CollectRepository;

use App\Models\Backend\Category;
use App\Models\Backend\Collect;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

use App\Models\Backend\Profile;
use App\Models\Access\User\User;
use Flash;

/**
 * Class CollectController.
 */
class CollectController extends AppBaseController
{
    
    public function __construct(CollectRepository $collectRepo)
    {
        $this->collectRepository = $collectRepo;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $type = $request->input('type')?$request->input('type'): 'product';

        $user_id = access()->user()->id;

        $collect_ids = Collect::select('product_id', 'seller_id')
            ->where('user_id', $user_id)
            ->get();

        $product_ids = array();
        $user_ids = array();
        foreach($collect_ids as $row) {
            if(is_null($row->product_id) || $row->product_id == '') {
                $user_ids[] = $row->seller_id;
            }
            else {
                $product_ids[] = $row->product_id;
            }
        }

        $products = Product::whereIn('id', $product_ids)->get();

        $profiles = Profile::whereIn('user_id', $user_ids)
            ->where('type', Collect::TYPE_COLLECT)
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();
        
        foreach($profiles as $profile) {
            province_city_name($profile);
            $profile->user = User::find($profile->user_id);
        }
        /*
        $users = User::whereIn('id', $user_ids)->get();

        foreach($users as $user) {
            $profile = Profile::where('user_id', $user->id)->first();
            if($profile)  {
                $user->avatar = $profile->avatar;
                $user->address = '地址';
            }
        }
         */


        return view('frontend.collects.index', compact('products', 'profiles'));
    }

    public function show(Request $request) 
    {
        return view('frontend.products.show', compact('product'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('frontend.products.create', compact('category_id'));
    }

    public function store(CreateCollectRequest $request)
    {
        $input = $request->all();

        $collect = Collect::where('product_id', $input['product_id'])
            ->where('user_id', $input['user_id'])
            ->first();
        if(!$collect)  {
            $this->collectRepository->create($input);
            Flash::success('收藏成功');
        }
        else {
            $this->collectRepository->delete($collect->id);
            Flash::success('取消收藏');
        }


        return redirect()->back();
    }

    public function like(Request $request) 
    {
        $input = $request->all();

        $collect = Collect::where('user_id', access()->user()->id);
        if(!isset($input['seller_id'])) {
            return redirect()->back();
        }

        $collect = $collect->where('seller_id', $input['seller_id'])
            ->where('type', Collect::TYPE_LIKE);
        $collect = $collect->first();
        if(!$collect) {
            $collect = new Collect;
            $collect->user_id = access()->user()->id;
            $collect->seller_id = $input['seller_id'];
            $collect->type = Collect::TYPE_LIKE;
            $collect->save();

            $profile = Profile::where('user_id', $input['seller_id'])->first();
            $profile->recommand_count ++;
            $profile->save();
        }
        else {
            $profile = Profile::where('user_id', $input['seller_id'])->first();
            $profile->recommand_count --;
            $profile->save();
            $this->collectRepository->delete($collect->id);
        }

        return redirect()->back();
    }

    public function collect(Request $request) 
    {
        $input = $request->all();

        $collect = Collect::where('user_id', access()->user()->id);
        if(!isset($input['seller_id'])) {
            return redirect()->back();
        }
        $collect = $collect->where('seller_id', $input['seller_id'])
            ->where('type', Collect::TYPE_COLLECT)
            ->first();
        if(!$collect) {
            $collect = new Collect;
            $collect->user_id = access()->user()->id;
            $collect->seller_id = $input['seller_id'];
            $collect->type = Collect::TYPE_COLLECT;
            $collect->save();
        }
        else {
            $this->collectRepository->delete($collect->id);
        }

        return redirect()->back();
    }
}
