<?php

use Illuminate\Support\Facades\Route;
use App\Models\LandingPageContent;

Route::get('/', function () {
    // Ambil semua konten dan ubah jadi format yang gampang diakses
    $contents = LandingPageContent::all()->pluck('content', 'section');
    return view('landing', ['contents' => $contents]);
});
