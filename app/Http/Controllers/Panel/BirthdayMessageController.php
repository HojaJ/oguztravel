<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\BirthdayMessage;
use App\Models\Email;
use Illuminate\Http\Request;

class BirthdayMessageController extends Controller
{
    public function index(Request $request)
    {
        $messages =  BirthdayMessage::where('name', '<>','Birthday TM')->where('name', '<>','Birthday RU')->get();
        return view('panel.birthday_messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        BirthdayMessage::create($request->all());
        return redirect()->route('panel.sms_messages.index')->with('success', __('Created message'));
    }

    public function edit(BirthdayMessage $sms_message)
    {
        return view('panel.birthday_messages.edit', compact('sms_message'));
    }

    public function update( Request $request, BirthdayMessage $sms_message)
    {
        $sms_message->update([
            'name' => $request->name ?? $sms_message->name,
            'lang' => $request->lang ?? $sms_message->lang,
            'content' => $request->message,
        ]);
        return redirect()->back()->with('success', __('Updated message'));
    }

    public function destroy(BirthdayMessage $sms_message)
    {
        $sms_message->delete();
        return redirect()->back()->with('danger', __('Deleted msg', ['name' => __('Birthday message')]));
    }

    public function birthday_message(Request $request)
    {
        $messages =  BirthdayMessage::where('name','=', 'Birthday TM')->orWhere('name','=', 'Birthday RU')->get();
        $email = Email::where('name','=','Birthday EN')->first();
        return view('panel.birthday_templates.index', compact('messages','email'));
    }

    public function birthday_message_show(Request $request, BirthdayMessage $sms_message)
    {
        return view('panel.birthday_templates.edit', compact('sms_message'));
    }
}
