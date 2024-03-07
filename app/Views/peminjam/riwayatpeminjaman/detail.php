<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
                <i class="fas fa-book-open-reader"></i>
            </div>
            <div class="sidebar-brand-text mx-3">JLibrary</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/peminjam">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Buku -->
        <li class="nav-item">
            <a class="nav-link" href="/peminjam/buku">
                <i class="fas fa-fw fa-book"></i>
                <span>Daftar Buku</span></a>
        </li>

        <!-- Nav Item - Koleksi Pribadi -->
        <li class="nav-item">
            <a class="nav-link" href="/peminjam/koleksipribadi">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Koleksi Pribadi</span></a>
        </li>

        <!-- Nav Item - Ulasan -->
        <li class="nav-item">
            <a class="nav-link" href="/peminjam/ulasan">
                <i class="fas fa-fw fa-star"></i>
                <span>Ulasan</span></a>
        </li>

        <!-- Nav Item - Riwayat Peminjaman -->
        <li class="nav-item active">
            <a class="nav-link" href="/peminjam/riwayatpeminjaman">
                <i class="fas fa-fw fa-clock-rotate-left"></i>
                <span>Riwayat Peminjaman</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $username; ?></span>
                            <i class="fa-solid fa-user"></i> </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('/logout'); ?>">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Detail Peminjaman</h1>
                        </div>

                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Informasi Peminjaman</h5>
                                <p><strong>Judul:</strong> <?= $detailRiwayat['Judul']; ?></p>
                                <p><strong>Sampul:</strong> <img src="/img/<?= $detailRiwayat['Sampul']; ?>" alt="" class="sampul ms-3" width="80px"></p>
                                <p><strong>Deskripsi:</strong> <?= $detailRiwayat['Deskripsi']; ?></p>
                                <p><strong>Tanggal Peminjaman:</strong> <?= $detailRiwayat['TanggalPeminjaman']; ?></p>
                                <p><strong>Tanggal Pengembalian:</strong> <?= $detailRiwayat['TanggalPengembalian']; ?></p>
                            </div>
                        </div>

                        <!-- Form ulasan -->
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Ulasan dan Rating</h5>
                                <form action="/peminjam/ulasan/save" method="post">
                                    <?php if (!empty($detailRiwayat) && array_key_exists('BukuID', $detailRiwayat)) : ?>
                                        <input type="hidden" name="BukuID" value="<?= $detailRiwayat['BukuID']; ?>">
                                        <?= var_dump($detailRiwayat['BukuID']); ?>

                                        <input type="hidden" name="PeminjamanID" value="<?= $detailRiwayat['PeminjamanID']; ?>">
                                    <?php else : ?>
                                        <!-- Tampilkan pesan kesalahan atau berikan tindakan yang sesuai -->
                                        <!-- <p>Data peminjaman tidak tersedia.</p> -->
                                    <?php endif; ?>
                                    <!-- Rating -->
                                    <div class="form-group">
                                        <label for="Rating">Rating:</label>
                                        <div class="rating">
                                            <span class="star" data-rating="1">&#9733;</span>
                                            <span class="star" data-rating="2">&#9733;</span>
                                            <span class="star" data-rating="3">&#9733;</span>
                                            <span class="star" data-rating="4">&#9733;</span>
                                            <span class="star" data-rating="5">&#9733;</span>
                                        </div>
                                        <input type="hidden" name="Rating" id="Rating" value="0">
                                        <?php if (isset($validation) && $validation->getError('Rating')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('Rating'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Ulasan -->
                                    <div class="form-group">
                                        <label for="Ulasan">Ulasan:</label>
                                        <textarea class="form-control <?= isset($validation) && $validation->hasError('Ulasan') ? 'is-invalid' : ''; ?>" id="Ulasan" name="Ulasan" rows="3" required><?= old('Ulasan'); ?></textarea>
                                        <?php if (session()->has('errUlasan')) : ?>
                                            <div class="invalid-feedback"><?= session('errUlasan'); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star');

        stars.forEach(function(star) {
            star.addEventListener('click', function() {
                const rating = this.dataset.rating;
                document.getElementById('Rating').value = rating;

                // Menghapus kelas 'active' dari semua bintang
                stars.forEach(function(s) {
                    s.classList.remove('active');
                });

                // Menambahkan kelas 'active' ke bintang yang diklik dan bintang sebelumnya
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('active');
                }
            });
        });
    });
</script>


<?= $this->endSection(); ?>