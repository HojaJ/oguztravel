<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Mail\DynamicMessage;
use App\Models\BirthdayMessage;
use App\Models\Email;
use App\Models\MailHistory;
use App\Models\Mailing;
use App\Models\Person;
use App\Models\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MailingController extends Controller
{
    public function index()
    {
        $emails = Email::where('name', '!=', 'Birthday EN')->get();
        $smss = BirthdayMessage::get();
        $mailings = Mailing::with('email')->get();
        return view('panel.mailing.index', compact('mailings', 'emails', 'smss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $mailing = Mailing::create([
                'name' => $request->name,
                'mail' => $request->mail ?? 1,
                'category' => $request->client_type,
                'type' => $request->type,
                'sms_id' => $request->sms,
                'lang_type' => $request->lang_type,
            ]);
            return redirect()->back()->with('success', __('Created msg', ['name' => __('Mailing')]));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Mailing $mailing
     * @return \Illuminate\Http\Response
     */
    public function show(Mailing $mailing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Mailing $mailing
     * @return \Illuminate\Http\Response
     */
    public function edit(Mailing $mailing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Mailing $mailing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mailing $mailing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Mailing $mailing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mailing $mailing)
    {
        $mailing->delete();

        return redirect()->route('panel.mailing.index')->with('danger', __('Deleted msg', ['name' => __('Mailing')]));
    }

    public function start(Request $request, Mailing $mailing)
    {
        if ($request->ajax()) {
            if ($mailing->type === 'email') {
                $persons = Person::select('email')->whereIn('lang', $mailing->lang_type);
                if ($mailing->category !== 'all') {
                    $persons->where('gender', $mailing->category);
                }
                $persons = $persons->get();
                foreach ($persons as $person) {
                    try {
                        MailHistory::create([
                            'to' => $person->email,
                            'sent_time' => now(),
                            'content' => $mailing->email->id,
                            'type' => 'bulk'
                        ]);
                        \Mail::mailer('private')->to($person->email)->send(new DynamicMessage($mailing->email->html));
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                }
            } else {
                $persons = Person::select('phone', 'lang')->where('lang', $mailing->lang_type);
                if ($mailing->category !== 'all') {
                    $persons->where('gender', $mailing->category);
                }
                $persons = $persons->get();
                foreach ($persons as $phone) {
                    $to = null;
                    if (Str::startsWith($phone->phone, '+993')) {
                        $to = $phone->phone;
                    } else if (Str::startsWith($phone->phone, '993')) {
                        $to = '+' . $phone->phone;
                    } else if (Str::startsWith($phone->phone, '86')) {
                        $to = '+993' . substr($phone->phone, 1);
                    }
                    $message = BirthdayMessage::where('id', $mailing->sms_id)->first();
                    if ($to) {
                        SMS::create([
                            'type' => 'bulk',
                            'to' => $to,
                            'uuid' => uuid_create(),
                            'content' => $message->content,
                        ]);
                    }
                }
            }
            $mailing->update([
                'status' => true
            ]);
        }
    }
}
