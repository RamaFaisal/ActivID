<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use Illuminate\Http\Request;

class PublicKonserController extends Controller
{
    public function index()
    {
        $konsers = Konser::where('status_konser', 'aktif')->latest()->get();
        return view('konser.index', compact('konsers'));
    }

    public function show($slug)
    {
        $konser = Konser::where('slug', $slug)->where('status_konser', 'aktif')->firstOrFail();
        return view('konser.show', compact('konser'));
    }
}
