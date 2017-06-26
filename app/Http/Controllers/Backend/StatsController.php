<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Access\User\User;
use App\Models\Backend\Profile;
use App\Models\Backend\Category;
use Carbon\Carbon;
use DB;

class StatsController extends Controller
{
    //
    public function users(Request $request) {
        $period = $request->input('period', 'day');
        $type = $request->input('type', Category::TYPE_USER);
        $categories = Category::select('id', 'display_name')->where('type', $type)->pluck('display_name', 'id');

        $profiles = Profile::select('category_ids', 'created_at')->where('type', $type)->get()->groupBy(function($profile) use ($period) {
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
            }
        }

        return view('backend.stats.index', compact('stats', 'categories', 'period', 'type'));
    }

    public function products() {
    }

    public function orders() {
    }
}
