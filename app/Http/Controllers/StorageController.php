<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function show($folder, $file)
    {
        $filePath = $folder . '/' . $file;

        if (! Storage::disk('s3')->exists($filePath))
            abort(404);

        return Storage::disk('s3')->response($filePath);
    }

}
