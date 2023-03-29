<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
}
