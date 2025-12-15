<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortofolioImage extends Model
{
    protected $table = 'portofolio_images';

    protected $fillable = ['portofolio_id', 'image', 'order'];

    public function portofolio() {
        return $this->belongsTo(Portofolio::class);
    }

}
