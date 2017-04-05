<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Backend\Category;
use App\Models\Backend\Profile;
use App\Models\Backend\Collect;
use App\Models\Backend\Industry;
use App\Models\Backend\Product;
use App\Models\Access\User\User;
use Illuminate\Http\Request;

use Flash;

/**
 * Class FrontendController.
 */
class ProfileController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    }

    public function show(Request $request) 
    {
        $user_id = $request->input('user_id');
        $category_id = $request->input('category_id');
        $time = $request->input('time');

        if(!$user_id) {
            $user_id = access()->user()->id;
        }

        $product_name = $request->input('product_name');

        $user = User::find($user_id);
        $profile = Profile::where('user_id', $user_id)->first();
        $industry = Industry::where('user_id', $user_id)->first();

        $products = Product::where('user_id', $user_id);
        if($product_name) {
            $products->where('title', 'LIKE', '%'.$product_name.'%');
        }

        if($category_id) {
            $products = $products->where('category_id', $category_id);
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

        $products = $products->get();

        foreach($products as $product) {
            $product = province_city_name($product);
        }
        
        $categories = get_product_categories($profile->type);

        $like = Collect::where('user_id', access()->user()->id)
            ->where('seller_id', $user_id)
            ->where('type', Collect::TYPE_LIKE)->first();
        $collect = Collect::where('user_id', access()->user()->id)
            ->where('seller_id', $user_id)
            ->where('type', Collect::TYPE_COLLECT)->first();

        return view('frontend.profiles.show', compact('user', 'profile', 'industry', 'products', 'categories', 'product_name', 'user_id', 'like', 'collect', 'category_id', 'time'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = access()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        return view('frontend.profiles.create', compact('profile', 'user'));
    }

    public function store(Request $request) {
        $user = access()->user();

        $realname = $request->input('realname');
        $identity_str = $request->input('identity_str');
        $identity_urls = json_encode($request->input('identity_urls'));

        if(!$realname) {
            Flash::error('请输入真实姓名');
            return redirect()->back();
        }
        if(!$identity_str) {
            Flash::error('请输入证件号');
            return redirect()->back();
        }
        $profile = Profile::where('user_id', $user->id)->first();
        if(!$profile) {
            $profile = new Profile;
            $profile->user_id = $user->id;
        }

        $profile->realname = $realname;
        $profile->identity_str = $identity_str;
        $profile->identity_urls = $identity_urls;
        $profile->is_identity = 1;

        $profile->save();
        Flash::success('上传成功，请等待审核');
        return redirect()->route('frontend.user');
    }

    public function recommand(Request $request) 
    {
        $user_id = $request->input('user_id');
        $profile = Profile::where('user_id', $user_id)->first();
        if(!$profile) {
            //
        }
        $profile->recommand_count ++;
        $profile->save();

        return redirect()->back();
    }
}
