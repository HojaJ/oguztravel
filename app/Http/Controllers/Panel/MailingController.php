<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\Mailing;
use Illuminate\Http\Request;

class MailingController extends Controller
{
    public function index()
    {
        $emails = Email::get();
        $mailings = Mailing::with('email')->get();
        return view('panel.mailing.index', compact('mailings','emails' ));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Mailing::create([
            'name' => $request->name,
            'mail' => $request->mail,
            'category' => $request->client_type,
        ]);

        return redirect()->back()->with('success', __('Created msg', ['name' => __('Mailing')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mailing  $mailing
     * @return \Illuminate\Http\Response
     */
    public function show(Mailing $mailing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mailing  $mailing
     * @return \Illuminate\Http\Response
     */
    public function edit(Mailing $mailing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mailing  $mailing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mailing $mailing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mailing  $mailing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mailing $mailing)
    {
        $mailing->delete();

        return redirect()->route('panel.mailing.index')->with('danger', __('Deleted msg', ['name' => __('Mailing')]));
    }
}
