<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Services;
use App\Models\Portofolio;

class HomeController extends Controller
{
    public function index() 
    {
         // Ambil semua data
        $settings = Settings::first(); // atau ::all() tergantung kebutuhan
        $services = Services::all();
        
        $portofolioQuery = Portofolio::with('images')->latest();
        
        // Filter paket jika ada
        if ($request->has('paket')) {
            $portofolioQuery->where('paket', $request->paket);
        }
        
        $portofolio = $portofolioQuery->get();
        $portofolioGrouped = $portofolio->groupBy('paket');

        return response()->json([
            'message' => 'Data Homepage Berhasil Dimuat',
            'data' => [
                'settings' => $settings,
                'services' => $services,
                'portofolio' => $portofolio,
                'portofolio_grouped' => $portofolioGrouped
            ]
        ], 200);
    }
}
