<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function download($template) {
        $uri = 'public/templates/'.$template;
        return Storage::download($uri);
    }
}
