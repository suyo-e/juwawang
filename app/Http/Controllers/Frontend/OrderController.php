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
        $purchase_orders = Order::where('user_id', $user_id)->get();
        foreach($purchase_orders as $order) {
            $product = Product::find($order->product_id);

            if($product) 
                $order->product = $product;
        }

        $products = Product::where('user_id', $user_id)->get();
        $product_array = array();
        $product_ids = array();
        foreach($products as $product) {
            $product_ids[] = $product->id;
            $product_array[$product->id] = $product;
        }

        $sell_orders = Order::whereIn('product_id', $product_ids)->get();
        foreach($sell_orders as $order) {
            if(isset($product_array[$order->product_id])) {
                $order->product = $product_array[$order->product_id];
                $order->user = User::find($order->user_id);
                $order->profile = Profile::where('user_id', $order->user_id)->first();
            }
        }

        return view('frontend.orders.index', compact('sell_orders', 'purchase_orders'));
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

        $product = Product::find($input['product_id']);
        $input['price'] = $product->price;

        $input['user_id'] = $user->id;

        $province_city = explode(',', $input['province_city']);
        $input['prov_id'] = $province_city[0];
        $input['city_id'] = $province_city[1];

        $input['status'] = Order::STATUS_UNPAID;

        $order = Order::create($input);
        Flash::success('发布成功');
        return redirect(route('frontend.orders.success', ['product_id'=>$input['product_id']]));
    }

    public function success(Request $request) 
    {
        $product_id = $request->input('product_id');
        return view('frontend.orders.success', compact('product_id'));
    }
}
