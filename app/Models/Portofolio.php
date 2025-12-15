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
        'tanggal_projek'
    ];


public function images()
{
    return $this->hasMany(PortofolioImage::class)->orderBy('order');
}


}
