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
        $users = User::whereIn('id', $user_ids)->get();

        foreach($users as $user) {
            $profile = Profile::where('user_id', $user->id)->first();
            if($profile)  {
                $user->avatar = $profile->avatar;
                $user->address = '地址';
            }
        }


        return view('frontend.collects.index', compact('products', 'users'));
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
        if(!$collect) 
            $this->collectRepository->create($input);

        Flash::success('收藏成功');

        return redirect()->back();
    }
}
