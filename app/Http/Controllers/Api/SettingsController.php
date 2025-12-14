<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $settings = Settings::all();

        return response()->json([
            'message' => 'Berhasil Ditampilkan',
            'data' => $settings
        ]);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $settings = Settings::find($id);

        if (!$settings) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
        $validasi = $request->validate([
            'site_title' => 'required|string',
            'logo' => 'nullable|string',
            'address'=> 'required|string|max:255',
            'email_contact' => 'required|string|max:255',
            'instagram' => 'required|string|max:255',
            'li' => 'required|string|max:255',
            'facebook' => 'required|string|max:255',
        ]);

        $settings->update($validasi);

        return response()->json([
            'message' => 'Data Berhasil di Update',
            'data' => $settings
        ]);

        
    }


}
