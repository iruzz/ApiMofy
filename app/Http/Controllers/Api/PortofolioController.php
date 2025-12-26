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
    // GET ALL (dengan filter paket optional)
    // =========================
    public function index(Request $request)
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

    // =========================
    // CREATE PORTOFOLIO + IMAGES
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'deskripsi' => 'required|string',
            'fitur_website' => 'required|array',
            'fitur_website.*' => 'string',
            'tanggal_projek' => 'required|date',
            'paket' => 'required|in:umkm,profesional,premium', // ← Fixed typo: profesional not professional
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120' // ← Added webp, increased to 5MB
        ]);

        // Handle fitur_website if it comes as JSON string from FormData
        $fiturWebsite = $request->fitur_website;
        if (is_string($fiturWebsite)) {
            $decoded = json_decode($fiturWebsite, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $fiturWebsite = $decoded;
            }
        }

        // 1️⃣ simpan portofolio
        $portofolio = Portofolio::create([
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'fitur_website' => $fiturWebsite,
            'tanggal_projek' => $request->tanggal_projek,
            'paket' => $request->paket,
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

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $portofolio = Portofolio::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'fitur_website' => 'nullable|array',
            'fitur_website.*' => 'string',
            'tanggal_projek' => 'nullable|date',
            'paket' => 'nullable|in:umkm,profesional,premium', // ← Fixed typo
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120', // ← Added webp, increased to 5MB
        ]);

        // 🔁 UPDATE DATA (kalau ada)
        $data = $request->only(['title', 'deskripsi', 'fitur_website', 'tanggal_projek', 'paket']);

        // If fitur_website comes as JSON string (from FormData), decode it
        if (isset($data['fitur_website']) && is_string($data['fitur_website'])) {
            $decoded = json_decode($data['fitur_website'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['fitur_website'] = $decoded;
            }
        }

        $portofolio->fill($data);
        $portofolio->save();

        // ➕ TAMBAH GAMBAR BARU (AUTO)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('portofolio', 'public');

                $portofolio->images()->create([
                    'image' => $path
                ]);
            }
        }

        return response()->json([
            'message' => 'Portofolio berhasil diperbarui',
            'data' => $portofolio->fresh('images')
        ], 200);
    }
    
    // =========================
    // STORE IMAGES TO EXISTING PORTFOLIO
    // =========================
    public function storeImages(Request $request, $id)
    {
        $portofolio = Portofolio::findOrFail($id);

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // ← Added webp, increased to 5MB
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('portofolio', 'public');

                $uploadedImages[] = $portofolio->images()->create([
                    'image' => $path
                ]);
            }
        }

        return response()->json([
            'message' => 'Gambar berhasil ditambahkan',
            'data' => [
                'portofolio' => $portofolio->load('images'),
                'uploaded_count' => count($uploadedImages),
                'uploaded_images' => $uploadedImages
            ]
        ], 201);
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

    // =========================
    // REORDER IMAGE
    // =========================
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