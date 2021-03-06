<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateOrderRequest;
use App\Http\Requests\Backend\UpdateOrderRequest;

use App\Models\Backend\Category;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

use App\Models\Backend\Profile;
use App\Models\Backend\Order;
use App\Models\Access\User\User;
use Flash;

/**
 * Class FrontendController.
 */
class OrderController extends AppBaseController
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user_id = access()->user()->id;

        // 发出的
        $purchase_orders = Order::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        foreach($purchase_orders as $order) {
            $product = Product::withTrashed()->find($order->product_id);

            if($product) 
                $order->product = $product;
        }

        $products = Product::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        $product_array = array();
        $product_ids = array();
        foreach($products as $product) {
            $product_ids[] = $product->id;
            $product_array[$product->id] = $product;
        }

        $sell_orders = Order::whereIn('product_id', $product_ids)
		// 延迟5min
		->where('created_at', '<=', date("Y-m-d H:i:s", strtotime('-5 min')))
		->orderBy('created_at', 'desc')->get();
        foreach($sell_orders as $order) {
            if(isset($product_array[$order->product_id])) {
                $order->product = $product_array[$order->product_id];
                $order->user = User::find($order->user_id);
                $order->profile = Profile::where('user_id', $order->user_id)->first();
            }
        }

        return view('frontend.orders.index', compact('sell_orders', 'purchase_orders'));
    }

    public function show(Request $request) {
        $order_id = $request->input('order_id');

        $order = Order::find($order_id);
        $product = Product::find($order->product_id);

        $user = User::find($product->user_id);
        if (empty($product)) {
            Flash::error('商品不存在');
            return redirect()->back();
        }
        $order = province_city_name($order);

        return view('frontend.orders.show', compact('product', 'user', 'order'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $product_id = $request->input('product_id');
        
        $product = Product::find($product_id);

        $user = User::find($product->user_id);
        if (empty($product)) {
            Flash::error('商品不存在');
            return redirect()->back();
        }

        return view('frontend.orders.create', compact('product', 'user'));
    }

    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();
        $user = access()->user();

        /*
        $order = Order::where('user_id', $user->id)
            ->where('product_id', $input['product_id'])
            ->first();
        if($order) {
            return redirect()->back();
        }
         */

        $product = Product::find($input['product_id']);
        $input['price'] = $product->price;

        $input['user_id'] = $user->id;

        //$province_city = explode(',', $input['province_city']);
        $province_city = province_city($input['province_city']);
        $input['prov_id'] = $province_city['prov_id'];
        $input['city_id'] = $province_city['city_id'];
        $input['area_id'] = $province_city['area_id'];

        $input['status'] = Order::STATUS_UNPAID;

        $order = Order::create($input);
        //Flash::success('发布成功');
        //return redirect(route('frontend.orders.success', ['product_id'=>$input['product_id']]));
        //return redirect(route('frontend.products.show', ['product_id'=>$input['product_id']]));
        return redirect(route('frontend.user'));
    }

    public function success(Request $request) 
    {
        $product_id = $request->input('product_id');
        return view('frontend.orders.success', compact('product_id'));
    }
}
