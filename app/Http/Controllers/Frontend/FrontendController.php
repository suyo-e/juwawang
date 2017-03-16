<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;

use App\Models\Backend\Banner;
use Illuminate\Http\Request;
/**
 * Class FrontendController.
 */
class FrontendController extends AppBaseController
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $banners = Banner::get();
        return view('frontend.index', compact('banners'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    public function upload(Request $request) 
    {
        $files = $request->file();
        foreach($files as $key=>$file) {
            $path = upload($request, $key);
        }
    
        return $this->sendResponse(['path'=>$path], '上传成功');
    }

    public function setting() {
        return view('frontend.setting');
    }
}
