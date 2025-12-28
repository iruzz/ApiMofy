<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portofolio;
use App\Models\PortofolioImage;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =============================
        // PAKET UMKM (Rp 150k - 500k)
        // =============================
        
        $basic1 = Portofolio::create([
            'title' => 'Website Company Profile PT. Maju Jaya',
            'deskripsi' => 'Website company profile sederhana dengan tampilan modern dan profesional. Menampilkan profil perusahaan, visi misi, dan kontak.',
            'fitur_website' => [
                'Responsive Design',
                'Landing Page',
                'About Us',
                'Contact Form',
                'Google Maps Integration'
            ],
            'tanggal_projek' => '2024-01-15',
            'paket' => 'umkm',
            'harga_project' => 300000 // Rp 300.000
        ]);

        $basic2 = Portofolio::create([
            'title' => 'Website Portfolio Fotografer',
            'deskripsi' => 'Website portfolio untuk menampilkan hasil karya fotografi dengan galeri yang menarik.',
            'fitur_website' => [
                'Responsive Design',
                'Image Gallery',
                'About Me',
                'Contact Form',
                'Social Media Integration'
            ],
            'tanggal_projek' => '2024-02-20',
            'paket' => 'umkm',
            'harga_project' => 250000 // Rp 250.000
        ]);

        $basic3 = Portofolio::create([
            'title' => 'Landing Page Cafe & Resto',
            'deskripsi' => 'Landing page untuk cafe dengan menu makanan dan minuman, serta informasi lokasi dan jam buka.',
            'fitur_website' => [
                'Responsive Design',
                'Menu Display',
                'Location Maps',
                'Opening Hours',
                'WhatsApp Integration'
            ],
            'tanggal_projek' => '2024-03-10',
            'paket' => 'umkm',
            'harga_project' => 350000 // Rp 350.000
        ]);

        // =============================
        // PAKET PROFESIONAL (Rp 800k - 1.5jt)
        // =============================
        
        $standard1 = Portofolio::create([
            'title' => 'Website Sekolah SMA Negeri 1',
            'deskripsi' => 'Website sekolah lengkap dengan sistem informasi akademik, galeri kegiatan, dan berita sekolah. Dilengkapi dengan admin panel untuk update konten.',
            'fitur_website' => [
                'Responsive Design',
                'Admin Dashboard',
                'News & Article System',
                'Photo Gallery',
                'Student Information',
                'Teacher Profile',
                'Contact Form',
                'SEO Optimized'
            ],
            'tanggal_projek' => '2024-04-05',
            'paket' => 'profesional',
            'harga_project' => 1200000 // Rp 1.200.000
        ]);

        $standard2 = Portofolio::create([
            'title' => 'Website Klinik Sehat Sejahtera',
            'deskripsi' => 'Website klinik dengan sistem appointment online dan informasi layanan kesehatan lengkap.',
            'fitur_website' => [
                'Responsive Design',
                'Online Appointment',
                'Doctor Schedule',
                'Service Information',
                'Admin Panel',
                'Patient Registration',
                'News & Articles',
                'WhatsApp Integration'
            ],
            'tanggal_projek' => '2024-05-18',
            'paket' => 'profesional',
            'harga_project' => 1500000 // Rp 1.500.000
        ]);

        $standard3 = Portofolio::create([
            'title' => 'Website Properti Rumah Idaman',
            'deskripsi' => 'Website listing properti dengan filter pencarian dan detail lengkap setiap property.',
            'fitur_website' => [
                'Responsive Design',
                'Property Listing',
                'Advanced Search Filter',
                'Property Detail Page',
                'Admin Panel',
                'Image Gallery',
                'Contact Agent',
                'Google Maps',
                'SEO Friendly'
            ],
            'tanggal_projek' => '2024-06-22',
            'paket' => 'profesional',
            'harga_project' => 1800000 // Rp 1.800.000
        ]);

        // =============================
        // PAKET PREMIUM (Rp 3jt - 5jt)
        // =============================
        
        $premium1 = Portofolio::create([
            'title' => 'E-Commerce Fashion Store',
            'deskripsi' => 'Website toko online fashion lengkap dengan sistem pembayaran, manajemen produk, dan tracking pengiriman. Terintegrasi dengan payment gateway dan sistem inventory.',
            'fitur_website' => [
                'Responsive Design',
                'Product Management System',
                'Shopping Cart',
                'Multiple Payment Gateway',
                'Order Tracking',
                'Full Admin Dashboard',
                'Customer Account',
                'Review & Rating',
                'Shipping Integration',
                'SEO Advanced',
                'Email Notification',
                'Sales Report & Analytics'
            ],
            'tanggal_projek' => '2024-07-30',
            'paket' => 'premium',
            'harga_project' => 3500000 // Rp 3.500.000
        ]);

        $premium2 = Portofolio::create([
            'title' => 'Platform LMS (Learning Management System)',
            'deskripsi' => 'Platform pembelajaran online dengan sistem kelas, video pembelajaran, quiz, dan sertifikat digital. Mendukung multi-instructor dan payment subscription.',
            'fitur_website' => [
                'Responsive Design',
                'User Management (Student/Instructor/Admin)',
                'Course Management',
                'Video Streaming',
                'Quiz & Assignment',
                'Digital Certificate',
                'Payment Gateway',
                'Subscription System',
                'Live Chat Support',
                'Discussion Forum',
                'Progress Tracking',
                'Analytics Dashboard',
                'API Integration',
                'Email Automation'
            ],
            'tanggal_projek' => '2024-08-15',
            'paket' => 'premium',
            'harga_project' => 4800000 // Rp 4.800.000
        ]);

        $premium3 = Portofolio::create([
            'title' => 'Sistem Informasi Rumah Sakit',
            'deskripsi' => 'Sistem informasi rumah sakit terintegrasi dengan rekam medis elektronik, appointment system, pharmacy management, dan billing system.',
            'fitur_website' => [
                'Responsive Design',
                'Patient Registration',
                'Electronic Medical Record',
                'Doctor Schedule Management',
                'Online Appointment',
                'Queue Management',
                'Pharmacy Management',
                'Laboratory Integration',
                'Billing & Payment',
                'Insurance Claim',
                'Multi User Role (Doctor/Nurse/Admin/Pharmacist)',
                'Report & Analytics',
                'API Integration',
                'Real-time Notification',
                'Data Backup System'
            ],
            'tanggal_projek' => '2024-09-20',
            'paket' => 'premium',
            'harga_project' => 5500000 // Rp 5.500.000
        ]);

        // =============================
        // CONTOH TANPA HARGA (Optional)
        // =============================
        
        Portofolio::create([
            'title' => 'Website Toko Buku Online',
            'deskripsi' => 'Toko buku online dengan katalog lengkap dan sistem pencarian advanced.',
            'fitur_website' => [
                'Responsive Design',
                'Product Catalog',
                'Search & Filter',
                'Shopping Cart',
                'Payment Gateway',
                'Admin Panel'
            ],
            'tanggal_projek' => '2024-10-01',
            'paket' => 'umkm',
            // harga_project tidak diset (NULL) - tidak akan muncul harga di frontend
        ]);

        // Optional: Tambah dummy images jika diperlukan
        // $this->addDummyImages($basic1);
        // $this->addDummyImages($standard1);
        // $this->addDummyImages($premium1);
    }

    /**
     * Helper untuk tambah dummy images (optional)
     */
    private function addDummyImages($portofolio)
    {
        for ($i = 1; $i <= 3; $i++) {
            PortofolioImage::create([
                'portofolio_id' => $portofolio->id,
                'image' => 'portofolio/dummy-' . $portofolio->id . '-' . $i . '.jpg',
                'order' => $i
            ]);
        }
    }
}