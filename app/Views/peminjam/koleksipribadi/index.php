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
        <li class="nav-item active">
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
        <li class="nav-item">
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
                            <h1 class="h3 mb-0 text-gray-800">Daftar Buku dalam Koleksi Pribadi</h1>
                        </div>

                        <?php foreach ($koleksi as $k) : ?>
                            <div class="card mb-3" style="max-width: 850px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/img/<?= $k['Sampul']; ?>" class="img-fluid rounded-start" alt="<?= $k['Judul']; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $k['Judul']; ?></h5>
                                            <p class="card-text" style="font-size: 14px;"><?= $k['Deskripsi'] ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="card-text"><small class="text-muted"><?= $k['Penulis']; ?></small></p>
                                                <div>
                                                    <i class="fas fa-star"></i>
                                                    <?php if ($k['KoleksiID']) : ?>
                                                        <i class="fas fa-bookmark text-black"></i>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>



                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

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

<script>
    function tambahKoleksi(bukuID) {
        // Kirim permintaan AJAX untuk menambahkan ke koleksi pribadi
        fetch('/peminjam/tambahKoleksi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                bukuID: bukuID
            })
        })
        .then(response => {
            if (response.ok) {
                location.reload(); // Refresh halaman jika berhasil
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function hapusKoleksi(koleksiID) {
        // Kirim permintaan AJAX untuk menghapus dari koleksi pribadi
        fetch('/peminjam/hapusKoleksi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                koleksiID: koleksiID
            })
        })
        .then(response => {
            if (response.ok) {
                // Hapus kartu dari tampilan
                document.getElementById(`kartu-${koleksiID}`).remove();
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>


<?= $this->endSection(); ?>