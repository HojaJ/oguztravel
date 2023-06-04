<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use App\Mail\HotelMessage;
use App\Mail\TicketMessage;
use App\Mail\TranslationMessage;
use App\Mail\VisaMessage;
use App\Models\Country;
use App\Models\Cover;
use App\Models\Person;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestFile;
use App\Models\Subject;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $cover = Cover::whereSlug('service')->whereIsActive(true)->first();

        return view('web.services.index', compact('cover'));
    }

    public function show(Service $service)
    {
        $countries = Country::orderBy('name->en', 'ASC')->get();

        return view('web.services.show', compact('service', 'countries'));
    }

    public function store(Service $service, Request $request)
    {
        try {
            $rules = [
                'surname' => 'required',
                'name' => 'required',
                'patronymic' => 'nullable',
                'email' => 'required|email',
                'gender' => 'required',
                'phone' => 'required',
                'note' => 'nullable',
            ];

            if ($service->slug == 'visa') {
                $rules['country'] = 'nullable';
                $rules['planned_date'] = 'required';
    //            $rules['extra_docs.*'] = 'nullable|mimes:jpg,bmp,png,docx,pdf,zip,rar';
                $rules['extra_docs.*'] = 'nullable';

                if ($request->get('applicant_type' == 'inbound')) {
                    $rules['country'] = 'required';
                }
            }

            if ($service->slug == 'visa' || $service->slug == 'hotel') {
    //            $rules['doc_photos.*'] = 'nullable|mimes:jpg,bmp,png,docx,pdf,zip,rar';
                $rules['doc_photos.*'] = 'nullable';
            }

            if ($service->slug == 'hotel') {
                $rules['city'] = 'nullable';
                $rules['room_type'] = 'nullable';
                $rules['booking_date'] = 'nullable';
            }

            if ($service->slug == 'ticket') {
                $rules['ticket_from'] = 'nullable';
                $rules['ticket_to'] = 'nullable';
                $rules['boarding_date'] = 'nullable';
                $rules['returning_date'] = 'nullable';
            }

            if ($service->slug == 'translation') {
    //            $rules['scanned_documents.*'] = 'nullable|mimes:jpg,bmp,png,docx,pdf,zip,rar';
                $rules['scanned_documents.*'] = 'nullable';
            }

            if ($service->slug != 'translation') {
                $rules['date_of_birth'] = 'required';
                $rules['passport_number'] = 'nullable';
                $rules['expiry_date'] = 'nullable';
                $rules['scanned_passport_file'] = 'nullable';
            }

            $request->validate($rules);

            $request->merge([
                'type' => $service->slug,
                'phone' => $request->get('full_number'),
                'date_of_birth' => $request->get('date_of_birth') ? date('Y-m-d', strtotime($request->get('date_of_birth'))) : null,
                'expiry_date' => $request->get('expiry_date') ? date('Y-m-d', strtotime($request->get('expiry_date'))) : null,
            ]);

            if ($service->slug == 'ticket') {
                $request->merge([
                    'boarding_date_from' => $request->boarding_date,
                ]);
            }

            if ($service->slug == 'ticket' && $request->get('ticket_type') == 'round') {
                $request->merge([
                    'returning_date_from' => $request->returning_date,
                ]);
            }

            if ($service->slug == 'visa') {
                $planned_date = $request->get('planned_date');

                if (strlen($planned_date) == 10) {
                    $request->merge([
                        'planned_date_from' => date('Y-m-d', strtotime($request->get('planned_date'))),
                    ]);
                }

                if (strlen($planned_date) == 21) {
                    $range_date = explode(",", $planned_date);

                    $request->merge([
                        'planned_date_from' => date('Y-m-d', strtotime($range_date[0])),
                        'planned_date_to' => date('Y-m-d', strtotime($range_date[1])),
                    ]);
                }
            }

            if ($service->slug == 'hotel') {
                $booking_date = $request->get('booking_date');

                if (strlen($booking_date) == 10) {
                    $request->merge([
                        'booking_date_from' => date('Y-m-d', strtotime($request->get('booking_date'))),
                    ]);
                }

                if (strlen($booking_date) == 21) {
                    $range_date = explode(",", $booking_date);

                    $request->merge([
                        'booking_date_from' => date('Y-m-d', strtotime($range_date[0])),
                        'booking_date_to' => date('Y-m-d', strtotime($range_date[1])),
                    ]);
                }
            }


            $scanned_files_array = [];
            $scanned_passport_file = $request->file('scanned_passport_file');
            if ($scanned_passport_file) {
                $filename = [];
                foreach ($request->file('scanned_passport_file', []) as $key => $file) {
                    $filename['file_type'] = $file->extension();
                    $filename['filename'] = $this->uploadFile($file,'scanned_passport_file');
                    $scanned_files_array[] = $filename;
                }
            }

            if ($scanned_files_array) {
                $request->merge([
                    'scanned_passport' => json_encode($scanned_files_array),
                ]);
            }
            $service = ServiceRequest::create($request->all());

            $person_data = [
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
                'patronymic' => $request->get('patronymic'),
                'gender' => $request->get('gender'),
                'date_if_birth' => $request->get('date_of_birth')
            ];

            $person = Person::wherePhone($person_data['phone'])->whereEmail($person_data['email'])->first();

            if ($person) {
                $person->update($person_data);
            } else {
                Person::create($person_data);
            }

            foreach ($request->file('extra_docs', []) as $key => $file) {
                ServiceRequestFile::create([
                    'service_request_id' => $service->id,
                    'filename' => $this->uploadFile($file, 'service_request_files'),
                    'type' => 'extra_docs',
                ]);
            }

            foreach ($request->file('doc_photos', []) as $key => $file) {
                ServiceRequestFile::create([
                    'service_request_id' => $service->id,
                    'filename' => $this->uploadFile($file, 'service_request_files'),
                    'type' => 'doc_photos',
                ]);
            }

            foreach ($request->file('scanned_documents', []) as $key => $file) {
                ServiceRequestFile::create([
                    'service_request_id' => $service->id,
                    'filename' => $this->uploadFile($file, 'service_request_files'),
                    'type' => 'scanned_documents',
                ]);
            }

            if($service->slug == 'visa'){
                $email = Subject::where('type','Visa')->first()->email;
                \Mail::to($email)->send(new VisaMessage($service->toArray()));
            }elseif ($service->slug == 'hotel'){
                $email = Subject::where('type','Hotel')->first()->email;
                \Mail::to($email)->send(new HotelMessage($service->toArray()));
            }elseif ($service->slug == 'ticket'){
                $email = Subject::where('type','Ticket')->first()->email;
                \Mail::to($email)->send(new TicketMessage($service->toArray()));
            }elseif ($service->slug == 'translation'){
                $email = Subject::where('type','Translate')->first()->email;
                \Mail::to($email)->send(new TranslationMessage($service->toArray()));
            }

            return back()->with('success', __('Request has been sent'));
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}
