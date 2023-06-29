<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GatewayController extends Controller
{
    public function send_api(Request $request)
    {
        if($request->deviceId && $request->action){
            return response()->json([
                'message' => 'salam',
                'number' => '+99364336223',
                'messageId' => '1'
            ]);
        }
    }

    public function status_api(Request $request)
    {

    }
}
