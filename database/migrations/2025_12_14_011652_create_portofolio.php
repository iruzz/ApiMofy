<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('portofolio', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('deskripsi');
            $table->json('fitur_website');
            $table->enum('paket', ['umkm', 'profesional', 'premium']); 
            $table->decimal('harga_project', 12, 2)->nullable();
            $table->date('tanggal_projek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio');
    }
};