<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portofolio;
use App\Models\PortofolioImage;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    // =========================
    // GET ALL
    // =========================
    public function index()
    {
        $data = Portofolio::with('images')->latest()->get();

        return response()->json([
            'message' => 'Data Portofolio Ditemukan',
            'data' => $data
        ], 200);
    }

    // =========================
    // CREATE PORTOFOLIO + IMAGES
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'client' => 'required|string',
            'deskripsi' => 'required|string',
            'tanggal_projek' => 'required|date',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // 1️⃣ simpan portofolio
        $portofolio = Portofolio::create([
            'title' => $request->title,
            'client' => $request->client,
            'deskripsi' => $request->deskripsi,
            'tanggal_projek' => $request->tanggal_projek,
        ]);

        // 2️⃣ simpan gambar (jika ada)
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('portofolio', 'public');

                $images[] = PortofolioImage::create([
                    'portofolio_id' => $portofolio->id,
                    'image' => $path
                ]);
            }
        }

        return response()->json([
            'message' => 'Portofolio berhasil ditambahkan',
            'data' => [
                'portofolio' => $portofolio,
                'images' => $images
            ]
        ], 201);
    }

 
public function update(Request $request, $id)
{
    $portofolio = Portofolio::findOrFail($id);

    $request->validate([
        'title' => 'nullable|string',
        'client' => 'nullable|string',
        'deskripsi' => 'nullable|string',
        'tanggal_projek' => 'nullable|date',
        'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 🔁 UPDATE DATA (kalau ada)
    $portofolio->update(
        $request->only(['title', 'client', 'deskripsi', 'tanggal_projek'])
    );

    // ➕ TAMBAH GAMBAR BARU (AUTO)
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('portofolio', 'public'); 
            // ⬆️ otomatis masuk storage/app/public/portofolio

            $portofolio->images()->create([
                'image' => $path
            ]);
        }
    }

    return response()->json([
        'message' => 'Portofolio berhasil diperbarui',
        'data' => $portofolio->load('images')
    ]);
}


    // =========================
    // DELETE 1 IMAGE
    // =========================
    public function deleteImage($id)
    {
        $image = PortofolioImage::findOrFail($id);

        // hapus file fisik
        Storage::disk('public')->delete($image->image);

        // hapus dari DB
        $image->delete();

        return response()->json([
            'message' => 'Gambar berhasil dihapus',
            'data' => null
        ], 200);
    }

public function reorderImage(Request $request)
{
    $request->validate([
        'portofolio_id' => 'required|exists:portofolio,id',
        'orders' => 'required|array',
        'orders.*.id' => 'required|exists:portofolio_images,id',
        'orders.*.order' => 'required|integer',
    ]);

    foreach ($request->orders as $item) {
        $image = PortofolioImage::where('id', $item['id'])
            ->where('portofolio_id', $request->portofolio_id)
            ->first();

        // ❌ image bukan milik portofolio ini
        if (!$image) {
            return response()->json([
                'message' => 'Gambar tidak sesuai portofolio'
            ], 403);
        }

        $image->update([
            'order' => $item['order']
        ]);
    }

    return response()->json([
        'message' => 'Urutan gambar berhasil diperbarui'
    ]);
}



    // =========================
    // DELETE PORTOFOLIO + ALL IMAGES
    // =========================
    public function destroy($id)
    {
        $portofolio = Portofolio::with('images')->findOrFail($id);

        foreach ($portofolio->images as $img) {
            Storage::disk('public')->delete($img->image);
        }

        $portofolio->delete();

        return response()->json([
            'message' => 'Portofolio & semua gambar berhasil dihapus',
            'data' => null
        ], 200);
    }
}
