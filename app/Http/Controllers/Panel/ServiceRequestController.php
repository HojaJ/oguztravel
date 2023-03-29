<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use ZipArchive;
// use File;

class ServiceRequestController extends Controller
{
    private $type;

    public function __construct(Request $request)
    {
        $this->settype($request->get('type', 'visa'));
    }

    private function setType($type)
    {
        if (in_array($type, ['visa', 'ticket', 'hotel', 'translation'])) {
            $this->type = $type;
        } else {
            $this->type = 'visa';
        }
    }

    public function index()
    {
        $page_limit = 15;
        $type = $this->type;

        $services = ServiceRequest::whereType($type)->latest()->paginate($page_limit);

        return view('panel.service_requests.index', compact('services', 'page_limit', 'type'));
    }

    public function show(ServiceRequest $service)
    {
        $service->is_read = true;
        $service->save();
        $type = $this->type;

        return view('panel.service_requests.show', compact('service', 'type'));
    }

    public function delete(ServiceRequest $service)
    {
        $type = $this->type;
        $service->delete();

        return redirect()->route('panel.service_requests.index', ['type' => $type])->with('danger', __('Deleted msg', ['name' => __('Service request')]));
    }

    public function downloadZip(ServiceRequest $service, $file_type = 'doc_photos')
    {
        $todaysDir = public_path('temp/' . date('dmY') . '/');
        $yesterdaysDir = public_path('temp/' . date('dmY', strtotime("-1 days")));

        if (file_exists($yesterdaysDir)) {
            File::deleteDirectory($yesterdaysDir);
        }

        if (!file_exists($todaysDir)) {
            File::makeDirectory($todaysDir, 0777, true, true);
        }

        $zip = new ZipArchive();
        $filename = Str::random() . '.zip';

        if ($zip->open($todaysDir . $filename, ZipArchive::CREATE) === TRUE) {
            if ($file_type == 'doc_photos') {
                $files = $service->getDocPhotoFiles();
            }

            if ($file_type == 'extra_docs') {
                $files = $service->getExtraDocFiles();
            }

            if ($file_type == 'scanned_documents') {
                $files = $service->getScannedDocumentFiles();
            }

            foreach ($files as $key => $value) {
                $zip->addFile(storage_path('app/public/service_request_files/' . $value->filename), $value->filename);
            }

            $zip->close();
        }

        return response()->download($todaysDir . $filename);
    }
}
