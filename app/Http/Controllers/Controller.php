<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use multiOTP\SMSGateway\SMSGateway;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function uploadFile($file, $dir)
    {
        $filename = Str::random() . '.' . $file->extension();
        $file->move(storage_path('app/public/' . $dir), $filename);

        return $filename;
    }

    protected function removeFile($file, $dir)
    {
        $path = storage_path('app/public/' . $dir . '/' . $file);

        if (is_file($path)) {
            unlink($path);
        }
    }

    public function smsgeteway(Request $request)
    {
        $smsgateway = new SMSGateway();
        $smsgateway->setDataPath(public_path('data'));
        $url = $request->fullUrl();
        $device_id = $request->id;
//        if ((!empty($to)) && empty($device_id)) {
//            $device_id = substr(md5(uniqid("", true)), 0, 16);
//        } elseif ((empty($to)) && (!empty($device_id)) && (!file_exists($smsgateway->getDataPath() .$device_id))) {
//            $device_id = "";
//        }
        $smsgateway->setSharedSecret("secret");


    }
}
