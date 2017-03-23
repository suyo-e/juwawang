<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Models\Backend\Category;

/**
 * Class FrontendController.
 */
class CategoryApiController extends AppBaseController
{

    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        $parent_id = $request->input('parent_id');

        $data = array();

        $categories = Category::select('display_name', 'id')
            ->orderBy('parent_id', 'asc')
            ->orderBy('type', 'asc');

        if($type) {
            $categories = $categories->where('type', $type);
        }
        if($parent_id) {
            $categories = $categories->where('parent_id', $parent_id);
        }
        else {
            $categories = $categories->where('parent_id', 0);
        }

        $categories = $categories->get();

        return $this->sendResponse($categories, 'show categires');
    }
}
