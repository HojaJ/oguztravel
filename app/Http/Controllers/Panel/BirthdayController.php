<?php

namespace App\Http\Controllers\Panel;


use App\Http\Controllers\Controller;
use App\Mail\BirthDayMessage;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function index(Request $request)
    {
        $page_limit = 30;
        $q = $request->get('q', null);
        if ($q) {
            $clients = Person::whereDate('date_of_birth',Carbon::today())->where(function ($query) use ($q){
                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhere('surname', 'like', '%' . $q . '%')
                    ->orWhere('patronymic', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%')
                    ->orWhere('phone', 'like', '%' . $q . '%')
                    ->orWhere('gender', 'like', '%' . $q . '%');
            })->paginate($page_limit);
        } else {
            $today=now();
            $clients = Person::whereMonth('date_of_birth',$today->month)
                ->whereDay('date_of_birth',$today->day)
                ->paginate($page_limit);
        }
        return view('panel.birthday.index', compact('clients', 'page_limit', 'q'));
    }

    public function send(Request $request, Person $person)
    {

        $email=strtolower($person->email);
//        \Mail::mailer('smtp2')->to($email)->send(new BirthDayMessage($person));
        return redirect()->back()->with('success','Birthday email sent to ' . $email);
    }
}
