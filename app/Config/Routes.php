<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/AuthController/loginProcess', 'AuthController::loginProcess');

$routes->get('/register', 'AuthController::register');
$routes->post('/AuthController/registerProcess', 'AuthController::registerProcess');
// $routes->get('/authcontroller/registerprocess', 'AuthController::registerProcess');

// Logout
$routes->get('/logout', 'AuthController::logout');

// Admin
$routes->get('/admin', 'AdminController::index');
$routes->get('/admin/index', 'AdminController::index');


// User
$routes->get('/admin/user', 'UserController::index');
$routes->get('/admin/user/create', 'UserController::create');
$routes->post('/user/save', 'UserController::save');
$routes->delete('/user/(:num)', 'UserController::delete/$1');
$routes->get('/admin/user/edit/(:any)', 'UserController::edit/$1');
$routes->post('/user/update/(:any)', 'UserController::update/$1');

// Petugas (for admin)
$routes->get('/admin/petugas', 'PetugasController::index');
$routes->get('/admin/petugas/create', 'PetugasController::create');
$routes->post('/petugas/save', 'PetugasController::save');
$routes->delete('/petugas/(:num)', 'PetugasController::delete/$1');
$routes->get('/admin/petugas/edit/(:any)', 'PetugasController::edit/$1');
$routes->post('/petugas/update/(:any)', 'PetugasController::update/$1');

// Buku (for admin)
$routes->get('/admin/buku', 'BukuController::index');
$routes->get('/buku', 'BukuController::index');
$routes->delete('/bukucontroller/(:num)', 'BukuController::delete/$1');
$routes->get('/admin/buku/create', 'BukuController::create');
$routes->post('/buku/save', 'BukuController::save');
$routes->get('/admin/buku/edit/(:any)', 'BukuController::edit/$1');
$routes->post('/buku/update/(:any)', 'BukuController::update/$1');
$routes->get('buku/filter/(:segment)', 'BukuController::filter/$1');

// Kategori (for admin)
$routes->get('/admin/kategori', 'KategoriController::index');
$routes->get('/admin/kategori/create', 'KategoriController::create');
$routes->delete('/kategori/(:num)', 'KategoriController::delete/$1');
$routes->post('/kategori/save', 'KategoriController::save');
$routes->get('/admin/kategori/edit/(:any)', 'KategoriController::edit/$1');
$routes->post('/kategori/update/(:any)', 'KategoriController::update/$1');

// Izin Peminjaman (for admin)
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('/admin/izinpeminjaman', 'IzinPeminjamanController::index');
});
$routes->get('/admin/izinpeminjaman', 'IzinPeminjamanController::index');
$routes->get('admin/izinpeminjaman/izinkan/(:num)', 'IzinPeminjamanController::izinkan/$1');

// Riwayat Peminjaman (for admin)
$routes->get('/admin/riwayatpeminjaman', 'RiwayatPeminjamanController::index');
$routes->post('admin/riwayatpeminjaman/kembalikan/(:num)', 'RiwayatPeminjamanController::kembalikanPeminjaman/$1');


// Halaman sebagai Petugas
$routes->get('/petugas', 'PetugasPageController::index');

// Buku (for petugas)
$routes->get('/petugas/buku', 'BukuPetugasController::index');
$routes->get('/petugas/buku/create', 'BukuPetugasController::create');
$routes->post('/bukupetugascontroller/save', 'BukuPetugasController::save');
$routes->get('/petugas/buku/edit/(:any)', 'BukuPetugasController::edit/$1');
$routes->post('/bukupetugas/update/(:any)', 'BukuPetugasController::update/$1');
$routes->delete('/bukupetugascontroller/(:num)', 'BukuPetugasController::delete/$1');

// Kategori (for petugas)
$routes->get('/petugas/kategori', 'KategoriPetugasController::index');
$routes->get('/petugas/kategori/create', 'KategoriPetugasController::create');
$routes->post('/kategoripetugas/save', 'KategoriPetugasController::save');
$routes->get('/petugas/kategori/edit/(:any)', 'KategoriPetugasController::edit/$1');
$routes->post('/kategoripetugas/update/(:any)', 'KategoriPetugasController::update/$1');
$routes->delete('/kategoripetugas/(:num)', 'KategoriPetugasController::delete/$1');

// Users (for petugas)
$routes->get('/petugas/user', 'UserPetugasController::index');
$routes->get('/petugas/user/create', 'UserPetugasController::create');
$routes->post('/userpetugas/save', 'UserPetugasController::save');
$routes->get('/petugas/user/edit/(:any)', 'UserPetugasController::edit/$1');
$routes->post('/userpetugas/update/(:any)', 'UserPetugasController::update/$1');
$routes->delete('/userpetugas/(:num)', 'UserPetugasController::delete/$1');



// Halaman sebagai Peminjam
$routes->get('/peminjam', 'PeminjamController::index');

$routes->get('/peminjam/buku', 'PeminjamController::buku');
$routes->get('/peminjam/peminjaman/create/(:any)', 'PeminjamController::peminjaman/$1');
$routes->post('/peminjam/peminjaman/konfirmasi', 'PeminjamController::konfirmasi');

// Riwayat peminjaman sebagai (Peminjam)
$routes->get('/peminjam/riwayatpeminjaman', 'PeminjamController::riwayat');

// Koleksi pribadi (Peminjam)
$routes->post('/peminjam/tambah-koleksi', 'PeminjamController::tambahKoleksi');



$routes->get('/tes', 'AuthController::coba');
