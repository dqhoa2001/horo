<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Admin\ShippingError;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.auth.login');
    }

    // public function test()
    // {
    //     $response = [
    //         "result" => "failed",
    //         "errInfo" => [
    //             "0" => [
    //                 "err_code" => "EA004",
    //                 "err_message" => "telの値が不正です"
    //             ],
    //             "user_order_id" => ""
    //         ]
    //     ];
    //     $firstErrorInfo = $response['errInfo'][0]['err_message'];
        
    //     // サイト運営者にメールを送信（保守フェーズになってから）
    //     \Mail::to('info@hoshino-mai.org')->send(new ShippingError($firstErrorInfo));
    //     return;
    // }
}
