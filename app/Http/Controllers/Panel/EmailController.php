<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    public function index()
    {
        $datas = Email::where('name','<>','Birthday EN')->get();
        return view('panel.emails.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            Email::create([
                'name' => $request->name,
                'data' => json_encode($request->data),
                'html' => $request->html,
                'lang' => $request->lang
            ]);
            return ['success'=>true];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        return view('panel.emails.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        if($request->ajax()){
            $email->update([
                'data' => json_encode($request->data),
                'html' => $request->html,
            ]);
            return ['success'=>true];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();
        return redirect()->back()->with('danger', __('Deleted msg', ['name' => __($email->name) ]));
    }
}
