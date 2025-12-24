<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Services;
use App\Models\Portofolio;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function settings()
    {
          $settings = Settings::all();

        return response()->json([
            'message' => 'Berhasil Ditampilkan',
            'data' => $settings
        ]);
    }

    public function services()
    {
        $services = Services::all();

        return response()->json([
            'message' => 'Data Layanan Ditemukan',
            'data' => $services
        ]);
    }

   public function portofolio(Request $request) 
   {
     $query = Portofolio::with('images')->latest();

        // Filter berdasarkan paket (jika ada parameter ?paket=basic)
        if ($request->has('paket')) {
            $query->where('paket', $request->paket);
        }

        $data = $query->get();

        // Group by paket (optional, jika mau tampil terkelompok)
        $grouped = $data->groupBy('paket');

        return response()->json([
            'message' => 'Data Portofolio Ditemukan',
            'data' => $data,
            'grouped' => $grouped // ← tambahan untuk kelompok per paket
        ], 200);
   }
}
