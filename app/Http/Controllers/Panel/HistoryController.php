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
        $messages = SMS::where('status', 1)->paginate(30);
        return view('panel.history.sms_history', compact('messages'));
    }

    public function history_mail(Request $request)
    {
        $messages = MailHistory::paginate(30);
        return view('panel.history.sms_history', compact('messages'));
    }
}
