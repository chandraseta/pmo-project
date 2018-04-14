<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function downloadTemplate($template) {
        $uri = 'templates/'.$template;
        return Storage::download($uri);
    }
}
