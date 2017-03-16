<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Backend\Category;
use App\Models\Backend\Product;

/**
 * Class FrontendController.
 */
class ClassController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::where('parent_id', 0)
            ->select('display_name', 'id')
            ->get();

        $class_value = array();
        $class_display_value = array();
        foreach($categories as $category) {
            $class_value[] = $category->id;
            $class_display_value[] = "'".$category->display_name."'";
        }

        $class_value = implode(',', $class_value);
        $class_display_value = implode(',', $class_display_value);


        $products = Product::orderBy('id', 'desc')
            ->get();

        return view('frontend.class.index', compact('class_value', 'class_display_value', 'products'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
