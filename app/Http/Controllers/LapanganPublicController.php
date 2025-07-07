<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganPublicController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::where('is_active', true)->with('user')->get();
        return view('lapangan.index', compact('lapangans'));
    }

    public function show(string $slug)
    {
        $lapangan = Lapangan::with(['user', 'sesiSewa'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('lapangan.show', compact('lapangan'));
    }
}