<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Backend\Category;
use App\Models\Backend\Product;
use App\Models\Backend\Profile;

use Illuminate\Http\Request;
/**
 * Class FrontendController.
 */
class ClassController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $category_id = $request->input('category_id');
        $time = $request->input('time');
        $from = $request->input('from');
        $province_city_code = $request->input('province_city_code');

        $product_name = $request->input('product_name');

        $user = access()->user();
        $products = Product::orderBy('id', 'desc');
        $profile = Profile::where('user_id', $user->id)->first();
        $types = get_product_types($profile->type);

        if($category_id) {
            $products = $products->where('category_id', $category_id);
        }
        else if($types) {
            $category_ids = Category::select('id')
                ->whereIn('type', $types)
                ->pluck('id')
                ->toArray();
            $products = $products->whereIn('category_id', $category_ids);
        }

        switch($time) {
        case 'week':
            $date = date("Y-m-d H:i:s", strtotime("-1 week"));
            $products = $products->where('created_at', '>', $date);
            break;
        case 'month':
            $date = date("Y-m-d H:i:s", strtotime("-1 month"));
            $products = $products->where('created_at', '>', $date);
            break;
        default:
        }

        switch($from) {
        case 'user':
            $profile_type = Category::TYPE_USER;
            $user_ids = Profile::where('type', Category::TYPE_USER)->pluck('user_id');
            $products = $products->whereIn('user_id', $user_ids);
            break;
        case 'agent':
            $profile_type = Category::TYPE_AGENT;
            $user_ids = Profile::where('type', Category::TYPE_AGENT)->pluck('user_id');
            $products = $products->whereIn('user_id', $user_ids);
            break;
        case 'manufacturer':
            $profile_type = Category::TYPE_MANUFACTURER;
            $user_ids = Profile::where('type', Category::TYPE_MANUFACTURER)->pluck('user_id');
            $products = $products->whereIn('user_id', $user_ids);
            break;
        }

        if($province_city_code) {
            $codes = province_city($province_city_code);

            $products = $products->where('prov_id', $codes['prov_id'])
                ->where('city_id', $codes['city_id'])
                ->where('area_id', $codes['area_id']);
        }

        if($product_name) {
            $products = $products->where('title', 'LIKE', "%$product_name%");
        }
        
        if(!isset($profile_type)) {
            $profile_type = $profile->type;
        }

        $categories = get_product_categories($profile_type);

        $products = $products->get();
        foreach($products as $product) {
            $product->province_city_name = province_city_name ($product)->province_city_name;
        }

        //dd($products[0]->province_city_name);
        return view('frontend.class.index', compact('categories', 'products', 'category_id', 'time', 'from', 'province_city_code', 'product_name', 'profile_type'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
