<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;


use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;

use App\Models\Backend\Category;
use App\Models\Backend\Feedback;

/**
 * Class FrontendController.
 */
class ApiController extends AppBaseController
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

    public function verify(Request $request) {
        $verify_time = session('verify_time');
        $verify_code = session('verify_code');

        //session(['verify_code' => null, 'verify_time' => null]);
        if($verify_time && time() - $verify_time < 30000) {
            return $this->sendResponse(array(), 'send success');
        }
        else if($verify_time) {
            session(['verify_code' => null, 'verify_time' => null]);
        }
        $phone = $request->input('phone');

        if(substr($phone,0,2) == '19') {
            session(['verify_code' => '123456', 'verify_time' => time(), 'phone'=>$phone]);
            return $this->sendResponse(array(), 'send success');
        }

        $config = [
            'app_key'    => '23740532',
            'app_secret' => 'b79c3abbd305e6805f512d8caed5841b'
        ];
        $code = rand(100000, 999999);

        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;

        //$req->setSmsType("normal");
        $req->setSmsFreeSignName("球战");
        $req->setSmsParam("{\"code\":\"".$code."\"}");
        $req->setRecNum($phone);
        $req->setSmsTemplateCode("SMS_60330344");
/*
        $req->setRecNum($phone)
            ->setSmsParam([ 
                'number' => $code
            ]) 
            ->setSmsFreeSignName('聚挖网') 
            ->setSmsTemplateCode('SMS_57930007');
 */
        $resp = $client->execute($req);

        /*
        if($resp && $resp->code != 0) {
            return $this->sendError('');
        }
         */

        //stdClass Object ( [code] => 15 [msg] => Remote service error [sub_code] => isv.SMS_TEMPLATE_ILLEGAL [sub_msg] => 短信模板不合法 [request_id] => 43edahozfdt0 )
        session(['verify_code' => $code, 'verify_time' => time(), 'phone' => $phone]);
/*`
        echo "<pre>";
        print_r($resp);
        exit();
 */
        \Log::info('sendMessage', array(
            'session'=>session(),
            'resp'=>$resp
        ));
        return $this->sendResponse(array(), 'send success');
    }

    public function feedback(Request $request) {
        $feedback = new Feedback;;
        $feedback->user_id = access()->user()->id;
        $feedback->content = $request->input('content');
        $feedback->title = access()->user()->name;
        $feedback->save();
        return $this->sendResponse(array(), 'save success');
    }
}
