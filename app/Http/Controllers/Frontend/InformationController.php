<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;

use App\Models\Backend\Banner;
use App\Models\Backend\Information;
use Illuminate\Http\Request;
/**
 * Class FrontendController.
 */
class InformationController extends AppBaseController
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $informations = Information::get();

        return view('frontend.information.index', compact('informations'));
    }

    public function show(Request $request) 
    {
        $id = $request->input('information_id');
        $information = Information::find($id);

        $information->view_count ++;
        $information->save();
        return view('frontend.information.show', compact('information'));
    }
}
