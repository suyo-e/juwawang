<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateProductRequest;
use App\Http\Requests\Backend\UpdateProductRequest;

use App\Models\Backend\Category;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

use App\Models\Backend\Profile;
use App\Models\Access\User\User;
use Flash;

/**
 * Class FrontendController.
 */
class ProductController extends AppBaseController
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = access()->user();

        $products = Product::where('user_id', $user->id)
            ->get();

        return view('frontend.products.index', compact('products'));
    }

    public function show(Request $request) 
    {
        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        if (empty($product)) {
            Flash::error('商品不存在');
            return redirect()->back();
        }

        $user_id = access()->user()->id;

        return view('frontend.products.show', compact('product', 'user_id'));
    }

    public function intend(Request $request) 
    {
        $product_id = $request->input('product_id');
        
        $product = Product::find($product_id);

        $user = User::find($product->user_id);
        if (empty($product)) {
            Flash::error('商品不存在');
            return redirect()->back();
        }
        return view('frontend.products.intend', compact('product', 'user'));
    }

    public function categories(Request $request)
    {
        $user = access()->user();
        $profile = Profile::where('user_id', $user->id)->first();

        $categories = Category::select('display_name', 'id')
            ->where('parent_id', 0);
        $type = 0;
        switch($profile->type) {
        case Category::TYPE_USER:
            $type = Category::TYPE_USER_PRODUCT;
            break;
        case Category::TYPE_AGENT:
            $type = Category::TYPE_AGENT_PRODUCT;
            break;
        case Category::TYPE_MANUFACTURER:
            $type = Category::TYPE_MANUFACTURER_PRODUCT;
            break;
        }
        if($type) {
            //$categories = $categories->where('type', $type);
        }
        $categories = $categories->get();

        return view('frontend.products.categories', compact('categories'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $category_id = $request->input('category_id');

        return view('frontend.products.create', compact('category_id'));
    }

    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        if($request->file('pic_url')) {
            $path = upload($request, 'pic_url');
            $input['pic_url'] = $path;
        }
        else {
            $input['pic_url'] = '';
        }

        $input['banner_urls'] = '';

        $user = access()->user();

        $input['user_id'] = $user->id;
        $input['contact_name'] = $user->name;
        $input['view_count'] = 0;
        $input['collect_count'] = 0;
        $input['status'] = Product::STATUS_UNPAID;

        $province_city = explode(',', $input['province_city']);
        $input['prov_id'] = $province_city[0];
        $input['city_id'] = $province_city[1];
        $input['industry_id'] = 0;

        $product = Product::create($input);
        Flash::success('发布成功');
        return redirect(route('frontend.class'));
    }
}
