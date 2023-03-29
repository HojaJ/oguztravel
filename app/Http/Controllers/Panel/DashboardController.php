<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('panel.index');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('panel.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required_with:password_confirmation|min:6|confirmed',
        ]);

        if ($request->has('password')) {
            $request->merge(['password' => bcrypt($request->get('password_confirmation'))]);
        }

        auth()->user()->update($request->all());

        return redirect()->route('panel.profile')->with('success', __('Updated msg', ['name' => __('Profile')]));
    }
}
