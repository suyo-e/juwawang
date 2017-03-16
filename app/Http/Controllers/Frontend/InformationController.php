<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;

use App\Models\Backend\Banner;
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
        return view('frontend.informations.index');
    }
}
