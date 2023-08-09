<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\MailHistory;
use App\Models\SMS;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history_sms(Request $request)
    {
        $page_limit = 30;
        $q = $request->get('q', null);
        if ($q) {
            $messages = SMS::where('status', 1)->latest()->where(function ($query) use ($q){
                $query->where('to', 'like', '%' . $q . '%');
            })->paginate($page_limit);
        } else {
            $messages = SMS::where('status', 1)->latest()->paginate($page_limit);
        }
        return view('panel.history.sms_history', compact('messages','page_limit', 'q'));
    }

    public function history_mail(Request $request)
    {
        $page_limit = 30;
        $q = $request->get('q', null);
        if ($q) {
            $messages = MailHistory::with('email')->orderBy('sent_time')->where(function ($query) use ($q){
                $query->where('to', 'like', '%' . $q . '%');
            })->paginate($page_limit);
        } else {
            $messages = MailHistory::with('email')->orderBy('sent_time','desc')->paginate($page_limit);
        }
        return view('panel.history.mail_history', compact('messages','page_limit', 'q'));
    }
}
