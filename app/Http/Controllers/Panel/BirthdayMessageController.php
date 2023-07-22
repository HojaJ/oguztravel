<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\BirthdayMessage;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class BirthdayMessageController extends Controller
{
    public function index(Request $request)
    {
        $messages =  BirthdayMessage::get();
        return view('panel.birthday_messages.index', compact('messages'));
    }

    public function edit(BirthdayMessage $birthday_message)
    {
        return view('panel.birthday_messages.edit', compact('birthday_message'));
    }

    public function update( Request $request, BirthdayMessage $birthday_message)
    {
        $birthday_message->update([
            'content' => $request->message
        ]);
        return redirect()->route('panel.birthday_messages.index')->with('success', __('Updated message'));
    }
}
