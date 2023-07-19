<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutImage;
use App\Models\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function store(Request $request)
    {
        SMS::create([
            'to' => $request->phone,
            'content' => $request->message
        ]);
        return redirect()->back()->with('success', __('Created sms', ['name' => __('Client')]));
    }
}
