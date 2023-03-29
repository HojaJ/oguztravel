<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();

        return view('panel.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        $message->is_read = true;
        $message->save();

        return view('panel.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('panel.messages.index')->with('danger', __('Deleted msg', ['name' => __('Message')]));
    }
}
