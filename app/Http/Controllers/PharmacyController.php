<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
        $eczaneler = [];

        if ($request->filled(['il', 'ilce'])) {
            $response = Http::withHeaders([
                'authorization' => 'apikey ' . env('COLLECT_API_KEY'),
                'content-type'  => 'application/json',
            ])->get('https://api.collectapi.com/health/dutyPharmacy', [
                'il'   => $request->il,
                'ilce' => $request->ilce
            ]);

            if ($response->successful()) {
                $eczaneler = $response->json()['result'] ?? [];
            }
        }
        else if ($request->filled(['il'])) {
            $response = Http::withHeaders([
                'authorization' => 'apikey ' . env('COLLECT_API_KEY'),
                'content-type'  => 'application/json',
            ])->get('https://api.collectapi.com/health/dutyPharmacy', [
                'il'   => $request->il
            ]);

            if ($response->successful()) {
                $eczaneler = $response->json()['result'] ?? [];
            }
        }

        return view('eczane', [
            'eczaneler' => $eczaneler,
            'il'        => $request->il,
            'ilce'      => $request->ilce
        ]);
    }
}
