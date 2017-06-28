<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Access\User\User;
use App\Models\Backend\Profile;
use App\Models\Backend\Product;
use App\Models\Backend\Order;
use App\Models\Backend\Category;
use Carbon\Carbon;
use DB;

class StatsController extends Controller
{
    //
    public function users(Request $request) {
        $period = $request->input('period', 'day');
        $type = $request->input('type', Category::TYPE_USER);
        #$categories = Category::select('id', 'display_name')->where('type', $type)->pluck('display_name', 'id');
 	$categories = Category::select('id', 'display_name')
	     ->where('type', $type)
	     ->where('parent_id', 0)
	     ->pluck('display_name', 'id');
        $province_city = $request->input('province_city');

	$profiles = Profile::select('category_id', 'category_ids', 'created_at');

	$prov_id = null;
	$city_id = null;
	$area_id = null;
	if($province_city) {
		$codes = explode('|', $province_city);
		$prov_id = isset($codes[0]) && is_numeric($codes[0]) ? $codes[0]: null;
		if($prov_id) {
			$profiles->where('prov_id', $prov_id);
		}
		$city_id = isset($codes[1]) && is_numeric($codes[1]) ? $codes[1]: null;
		if($city_id) {
			$profiles->where('city_id', $city_id);
		}
		$area_id = isset($codes[2]) && is_numeric($codes[2]) ? $codes[2]: null;
		if($area_id) {
			$profiles->where('area_id', $area_id);
		}
	}

        $profiles = $profiles->where('type', $type)->get()->groupBy(function($profile) use ($period) {
            switch($period) {
            case "day":
                return Carbon::parse($profile->created_at)->format('Ymd');
                break;
            case "week":
                return Carbon::parse($profile->created_at)->startOfWeek()->format('Ymd') . '-' . Carbon::parse($profile->created_at)->endOfWeek()->format('Ymd');
                break;
            case "month":
                return Carbon::parse($profile->created_at)->format('Ym');
                break;
            }
        });
        $stats = [];
        foreach($profiles as $date=>$rows) {
            if(!isset($stats[$date])) {
                $stats[$date] = [];
            }

            foreach($rows as $profile) {
/*
                $category_ids = explode('|', $profile->category_ids);
                foreach($category_ids as $id) {
                    if(!is_numeric($id)) {
                        continue;
                    }
                    if(!isset($stats[$date][$id])) {
                        $stats[$date][$id] = 1;
                    }
                    else {
                        $stats[$date][$id] ++;
                    }
                }
*/
			$id = $profile->category_id;

			if(!is_numeric($id)) {
				continue;
			}
			if(!isset($stats[$date][$id])) {
				$stats[$date][$id] = 1;
			}
			else {
				$stats[$date][$id] ++;
			}
            }
        }

        return view('backend.stats.users', compact('stats', 'categories', 'period', 'type', 'prov_id', 'city_id', 'area_id'));
    }

    public function products(Request $request) {
        $period = $request->input('period', 'day');
        $type = $request->input('type', Category::TYPE_USER);
        #$categories = Category::select('id', 'display_name')->where('type', $type)->pluck('display_name', 'id');

 	$categories = Category::select('id', 'display_name')
	     ->where('parent_id', 0);
        switch($type) {
        case \App\Models\Backend\Category::TYPE_USER:
	    $categories->where('type', \App\Models\Backend\Category::TYPE_USER_PRODUCT);
            break;
        case \App\Models\Backend\Category::TYPE_AGENT:
	    $categories->where('type', \App\Models\Backend\Category::TYPE_AGENT_PRODUCT);
            break;
        case \App\Models\Backend\Category::TYPE_MANUFACTURER:
	    $categories->where('type', \App\Models\Backend\Category::TYPE_MANUFACTURER_PRODUCT);
            break;
        default: 
            break;
        }
	$categories = $categories->pluck('display_name', 'id');
        $province_city = $request->input('province_city');

	$products = Product::select('products.category_id', 'products.created_at')
		->leftJoin('profiles', 'profiles.user_id', 'products.user_id')
		->where('profiles.type', $type);

	$prov_id = null;
	$city_id = null;
	$area_id = null;
	if($province_city) {
		$codes = explode('|', $province_city);
		$prov_id = isset($codes[0]) && is_numeric($codes[0]) ? $codes[0]: null;
		if($prov_id) {
			$products->where('profiles.prov_id', $prov_id);
		}
		$city_id = isset($codes[1]) && is_numeric($codes[1]) ? $codes[1]: null;
		if($city_id) {
			$products->where('profiles.city_id', $city_id);
		}
		$area_id = isset($codes[2]) && is_numeric($codes[2]) ? $codes[2]: null;
		if($area_id) {
			$products->where('profiles.area_id', $area_id);
		}
	}

        $products = $products->get()->groupBy(function($profile) use ($period) {
            switch($period) {
            case "day":
                return Carbon::parse($profile->created_at)->format('Ymd');
                break;
            case "week":
                return Carbon::parse($profile->created_at)->startOfWeek()->format('Ymd') . '-' . Carbon::parse($profile->created_at)->endOfWeek()->format('Ymd');
                break;
            case "month":
                return Carbon::parse($profile->created_at)->format('Ym');
                break;
            }
        });
        $stats = [];
        foreach($products as $date=>$rows) {
            if(!isset($stats[$date])) {
                $stats[$date] = [];
            }

            foreach($rows as $profile) {
/*
                $category_ids = explode('|', $profile->category_ids);
                foreach($category_ids as $id) {
                    if(!is_numeric($id)) {
                        continue;
                    }
                    if(!isset($stats[$date][$id])) {
                        $stats[$date][$id] = 1;
                    }
                    else {
                        $stats[$date][$id] ++;
                    }
                }
*/
			$id = $profile->category_id;

			if(!is_numeric($id)) {
				continue;
			}
			if(!isset($stats[$date][$id])) {
				$stats[$date][$id] = 1;
			}
			else {
				$stats[$date][$id] ++;
			}
            }
        }

        return view('backend.stats.products', compact('stats', 'categories', 'period', 'type', 'prov_id', 'city_id', 'area_id'));
    }

    public function orders(Request $request) {
        $period = $request->input('period', 'day');
        $type = $request->input('type', Category::TYPE_USER);
        #$categories = Category::select('id', 'display_name')->where('type', $type)->pluck('display_name', 'id');

 	$categories = Category::select('id', 'display_name')
	     ->where('parent_id', 0);
        switch($type) {
        case \App\Models\Backend\Category::TYPE_USER:
	    $categories->where('type', \App\Models\Backend\Category::TYPE_USER_PRODUCT);
            break;
        case \App\Models\Backend\Category::TYPE_AGENT:
	    $categories->where('type', \App\Models\Backend\Category::TYPE_AGENT_PRODUCT);
            break;
        case \App\Models\Backend\Category::TYPE_MANUFACTURER:
	    $categories->where('type', \App\Models\Backend\Category::TYPE_MANUFACTURER_PRODUCT);
            break;
        default: 
            break;
        }
	$categories = $categories->pluck('display_name', 'id');
        $province_city = $request->input('province_city');

	$orders = Order::select('orders.created_at', 'products.category_id')
		->leftJoin('products', 'products.id', 'orders.product_id');

	$prov_id = null;
	$city_id = null;
	$area_id = null;
	$user_ids = [];
	$profiles = Profile::select('id', 'user_id')->where('type', $type);
	if($province_city) {
		$codes = explode('|', $province_city);
		$prov_id = isset($codes[0]) && is_numeric($codes[0]) ? $codes[0]: null;
		if($prov_id) {
			$profiles->where('prov_id', $prov_id);
		}
		$city_id = isset($codes[1]) && is_numeric($codes[1]) ? $codes[1]: null;
		if($city_id) {
			$profiles->where('city_id', $city_id);
		}
		$area_id = isset($codes[2]) && is_numeric($codes[2]) ? $codes[2]: null;
		if($area_id) {
			$profiles->where('area_id', $area_id);
		}
	}
	$user_ids = $profiles->pluck('user_id');

        $orders = $orders->whereIn('orders.user_id', $user_ids)->get()->groupBy(function($profile) use ($period) {
            switch($period) {
            case "day":
                return Carbon::parse($profile->created_at)->format('Ymd');
                break;
            case "week":
                return Carbon::parse($profile->created_at)->startOfWeek()->format('Ymd') . '-' . Carbon::parse($profile->created_at)->endOfWeek()->format('Ymd');
                break;
            case "month":
                return Carbon::parse($profile->created_at)->format('Ym');
                break;
            }
        });
        $stats = [];
        foreach($orders as $date=>$rows) {
            if(!isset($stats[$date])) {
                $stats[$date] = [];
            }

            foreach($rows as $profile) {
/*
                $category_ids = explode('|', $profile->category_ids);
                foreach($category_ids as $id) {
                    if(!is_numeric($id)) {
                        continue;
                    }
                    if(!isset($stats[$date][$id])) {
                        $stats[$date][$id] = 1;
                    }
                    else {
                        $stats[$date][$id] ++;
                    }
                }
*/
			$id = $profile->category_id;

			if(!is_numeric($id)) {
				continue;
			}
			if(!isset($stats[$date][$id])) {
				$stats[$date][$id] = 1;
			}
			else {
				$stats[$date][$id] ++;
			}
            }
        }

        return view('backend.stats.orders', compact('stats', 'categories', 'period', 'type', 'prov_id', 'city_id', 'area_id'));
    }
}
