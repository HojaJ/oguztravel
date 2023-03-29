<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Cover;
use App\Models\Person;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestFile;
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
        $rules = [
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'nullable',
            'email' => 'required|email',
            'phone' => 'required',
            'note' => 'nullable',
        ];

        if ($service->slug == 'visa') {
            $rules['country'] = 'nullable';
            $rules['planned_date'] = 'required';
            $rules['extra_docs.*'] = 'nullable|mimes:jpg,bmp,png,docx,pdf,zip,rar';

            if ($request->get('applicant_type' == 'inbound')) {
                $rules['country'] = 'required';
            }
        }

        if ($service->slug == 'visa' || $service->slug == 'hotel') {
            $rules['doc_photos.*'] = 'nullable|mimes:jpg,bmp,png,docx,pdf,zip,rar';
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
            $rules['boarding_date_range'] = 'nullable';
        }

        if ($service->slug == 'translation') {
            $rules['scanned_documents.*'] = 'nullable|mimes:jpg,bmp,png,docx,pdf,zip,rar';
        }

        if ($service->slug != 'translation') {
            $rules['date_of_birth'] = 'required';
            $rules['passport_number'] = 'nullable';
            $rules['expiry_date'] = 'nullable';
            $rules['scanned_passport_file'] = 'nullable|mimes:jpg,bmp,png,docx,pdf,zip,rar';
        }

        $request->validate($rules);

        $request->merge([
            'type' => $service->slug,
            'phone' => $request->get('full_number'),
            'date_of_birth' => $request->get('date_of_birth') ? date('Y-m-d', strtotime($request->get('date_of_birth'))) : null,
            'expiry_date' => $request->get('expiry_date') ? date('Y-m-d', strtotime($request->get('expiry_date'))) : null,
        ]);

        if ($service->slug == 'ticket' && $request->get('ticket_type') == 'oneway') {
            $request->merge([
                'boarding_date_from' => date('Y-m-d', strtotime($request->get('boarding_date'))),
            ]);
        }

        if ($service->slug == 'ticket' && $request->get('ticket_type') == 'round') {
            $boarding_date = $request->get('boarding_date_range');

            if (strlen($boarding_date) == 10) {
                $request->merge([
                    'boarding_date_from' => date('Y-m-d', strtotime($request->get('boarding_date'))),
                ]);
            }

            if (strlen($boarding_date) == 21) {
                $range_date = explode(",", $boarding_date);

                $request->merge([
                    'boarding_date_from' => date('Y-m-d', strtotime($range_date[0])),
                    'boarding_date_to' => date('Y-m-d', strtotime($range_date[1])),
                ]);
            }
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

        $scanned_passport_file = $request->file('scanned_passport_file');

        if ($scanned_passport_file) {
            $request->merge([
                'scanned_passport_file_type' => $scanned_passport_file->extension(),
                'scanned_passport' => $this->uploadFile($scanned_passport_file, 'service_requests'),
            ]);
        }

        $service = ServiceRequest::create($request->all());

        $person_data = [
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'patronymic' => $request->get('patronymic'),
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

        return back()->with('success', __('Request has been sent'));
    }
}
