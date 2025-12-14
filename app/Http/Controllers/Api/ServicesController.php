<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::all();

        return response()->json([
            'message' => 'Data Layanan Ditemukan',
            'data' => $services
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string'
        ]);

        $services = Services::create($validasi);

        return response()->json([
            'message' => 'Berhasil di Tambah',
            'data' => $services
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $services = Services::find($id);

          $validasi = $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string'
        ]);


        if (!$services){
            return response()->json([
                'message' => 'Layanan Tidak Ada'
            ], 404);
        }

        $services->update($validasi);

        return response()->json([
            'message' => 'Layanan Berhasil di Ubah',
            'data' => $services
        ]);

        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $services = Services::find($id);

        $services->delete();

        return response()->json([
            'message' => 'Data Berhasil Di Hapus',
            'data' => $services
        ]);
    }
}
