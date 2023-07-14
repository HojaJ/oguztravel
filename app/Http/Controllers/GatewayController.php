<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GatewayController extends Controller
{
    public function send_api()
    {
        return response()->json([
            'id' => strval(random_int(1,99)),
            'phone' => '+99364336223',
            'text' => 'salam',
        ]);

    }

    public function status_api(Request $request)
    {
        \Log::info('created',$request->id);
        \Log::info('some',$request->all());
    }
}
