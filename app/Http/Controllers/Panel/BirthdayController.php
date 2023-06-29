<?php

namespace App\Http\Controllers\Panel;


use App\Http\Controllers\Controller;
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
            $clients = Person::whereDate('date_of_birth',Carbon::today())->paginate($page_limit);
        }
        return view('panel.birthday.index', compact('clients', 'page_limit', 'q'));
    }
}
