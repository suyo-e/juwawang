<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateProductRequest;
use App\Http\Requests\Backend\UpdateProductRequest;

use App\Models\Backend\Category;
use App\Models\Backend\Industry;
use App\Models\Backend\Collect;
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

        $products = Product::where('user_id', $user->id)->get();
        
        return view('frontend.products.index', compact('products'));
    }
    
    public function edit(Request $request) 
    {
        $user_id = access()->user()->id;

        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        if (empty($product)) {
            Flash::error('商品不存在');
            return redirect()->back();
        }
        $category_id = $product->category_id;
        $category = Category::find($category_id);
        $industry = Industry::where('user_id', $user_id)->first();
        $profile = Profile::where('user_id', $user_id)->first();

        $product->view_count ++;
        $product->save();


        $collect = Collect::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();
        
        $categories = get_product_categories($profile->type);

        $category_ids = [];
        $category_values = [];
        foreach($categories as $category) {
            $category_ids[] = $category->id;
            $category_values[] = "'".$category->display_name."'";
        }

        $product = province_city_name($product);

        return view('frontend.products.edit', compact('product', 'user_id', 'collect', 'category_id', 'category', 'industry', 'categories', 'profile', 'category_values', 'category_ids'));
    }



    public function show(Request $request) 
    {
        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        if (empty($product)) {
            Flash::error('商品不存在');
            return redirect()->back();
        }

        $product->view_count ++;
        $product->save();

        $user_id = access()->user()->id;


        $collect = Collect::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();
        $profile = Profile::where('user_id', $user_id)->first();

        return view('frontend.products.show', compact('product', 'user_id', 'collect', 'profile'));
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

        $categories = get_product_categories($profile->type);
        return view('frontend.products.categories', compact('categories'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $category_id = $request->input('category_id');

        $user = access()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $categories = get_product_categories($profile->type);

        $category_ids = [];
        $category_values = [];
        foreach($categories as $category) {
            $category_ids[] = $category->id;
            $category_values[] = "'".$category->display_name."'";
        }
        $category = Category::find($category_id);

        $industry = Industry::where('user_id', $user->id)->first();
        return view('frontend.products.create', compact('category_id', 'category', 'category_ids', 'category_values', 'industry'));
    }

    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $user = access()->user();

        $input['pic_url'] = $request->input('pic_url');
        $input['banner_urls'] = json_encode($request->input('banner_urls'));
        $input['user_id'] = $user->id;
        $input['contact_name'] = $user->name;
        $input['view_count'] = 0;
        $input['collect_count'] = 0;
        $input['status'] = Product::STATUS_UNPAID;

        $province_city = province_city($input['province_city']);
        $input['prov_id'] = $province_city['prov_id'];
        $input['city_id'] = $province_city['city_id'];
        $input['area_id'] = $province_city['area_id'];
        $input['industry_id'] = 0;

        if(is_null($input['brand_name'])) {
            $input['brand_name'] = '';
        }

        $product = Product::create($input);
        Flash::success('发布成功');
        return redirect(route('frontend.class'));
    }

    public function update(CreateProductRequest $request)
    {
        $input = $request->all();

        $user = access()->user();

        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        if(!$product) {
            Flash::error('商品不存在');
            return redirect()->back();
        }

        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->address = $request->input('address');
        $product->qq = $request->input('qq');
        $product->wechat = $request->input('wechat');
        $product->phone = $request->input('phone');
        $product->pic_url = $request->input('pic_url');

        $product->banner_urls = json_encode($request->input('banner_urls'));
        $product->user_id = $user->id;
        $product->contact_name = $user->name;
        $product->view_count = 0;
        $product->collect_count = 0;
        $product->status = Product::STATUS_UNPAID;

        $province_city = province_city($input['province_city']);
        $product->prov_id = $province_city['prov_id'];
        $product->city_id = $province_city['city_id'];
        $product->area_id = $province_city['area_id'];
        $product->industry_id = 0;

        $product->brand_name = $request->input('brand_name');
        if(is_null($product->brand_name)) {
            $product->brand_name = '';
        }

        $product->save();
        Flash::success('更新成功');
        return redirect(route('frontend.user'));
        //return redirect()->back();
    }

    public function delete(Request $request) {
        $product_id = $request->input('product_id');
        $product =  Product::find($product_id);

        if($product->user_id != access()->user()->id) {
            Flash::error('商品信息错误');
            return redirect()->back();
        }
        $product->delete();
        
        Flash::success('删除成功');
        return redirect()->back();
    }
}
