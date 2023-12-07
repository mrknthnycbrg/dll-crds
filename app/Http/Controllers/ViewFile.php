<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Support\Facades\Storage;

class ViewFile extends Controller
{
    public function __invoke($slug)
    {
        $research = Research::where('slug', $slug)->firstOrFail();

        return response()->file(Storage::path('public/'.$research->pdf_path));
    }
}
