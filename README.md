Login Admin
- > Route::post('/login', [AuthController::class, 'login'])->name('login');

==========================================================================

Halaman User

**READ DATA**

(Nama Perusahaan, Alamat, email, facebook dll.., default url) 
- > Route::get('/', [SettingsController::class, 'index']);

(layanan perusahaan, default url dan url layanan)
- > Route::get('/', [ServicesController::class, 'index']); 
- > Route::get('/layanan', [ServicesController::class, 'index']);

(portofolio perusahaan, default url dan url portofolio)
- > Route::get('/', [PortofolioController::class, 'index']);
- > Route::get('/portofolio', [PortofolioController::class, 'index']);

===========================================================================


Halaman Admin 

(logout admin)
- > Route::post('/logout', [AuthController::class, 'logout']);


( CRUD )
- > Route::resource('/profile', SettingsController::class);

- > Route::resource('/layanan', ServicesController::class);

- > Route::resource('/portofolio', PortofolioController::class);

    
( Hapus 1 Gambar Portofolio  )

- > Route::delete( 'portofolio/image/{id}', [PortofolioController::class, 'deleteImage'] );


( Mengurutkan Gambar Order Image )

- >  Route::post('portofolio/image/reorder', [PortofolioController::class, 'reorderImage']);
 
