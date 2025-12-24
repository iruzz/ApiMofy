<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $table = 'portofolio';

    protected $fillable = [
        'title',
        'client',
        'deskripsi',
        'fitur_website',
        'tanggal_projek',
        'paket' // ← tambah ini
    ];

    protected $casts = [
        'fitur_website' => 'array',
        'tanggal_projek' => 'date',
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