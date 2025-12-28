<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $table = 'portofolio';

    protected $fillable = [
        'title',
        'deskripsi',
        'fitur_website',
        'tanggal_projek',
        'paket',
        'harga_project', // ← TAMBAHIN INI BRO!
    ];

    protected $casts = [
        'fitur_website' => 'array',
        'tanggal_projek' => 'date',
        'harga_project' => 'decimal:2', // ← TAMBAHIN CAST INI JUGA!
    ];

    // Relationship
    public function images()
    {
        return $this->hasMany(PortofolioImage::class)->orderBy('order');
    }

    // Scope untuk filter berdasarkan paket
    public function scopePaketBasic($query)
    {
        return $query->where('paket', 'basic');
    }

    public function scopePaketStandard($query)
    {
        return $query->where('paket', 'standard');
    }

    public function scopePaketPremium($query)
    {
        return $query->where('paket', 'premium');
    }
}