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
        <li class="nav-item active">
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
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Daftar Buku</h1>
                </div>

                <!-- Daftar Buku -->
                <div class="row">
                    <?php foreach ($buku as $b) : ?>
                        <?php if (!isset($b['StatusPeminjaman']) || ($b['StatusPeminjaman'] != 1 && $b['StatusPeminjaman'] != 2)) : ?>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card card-sm h-100" style="width: 200px; height: 300px;">
                                    <img class="card-img-top sampul" src="/img/<?= $b['Sampul']; ?>" alt="">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $b['Judul']; ?></h4>
                                        <p class="card-text"><?= $b['Penulis']; ?></p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <a href="/peminjam/peminjaman/create/<?= $b['BukuID']; ?>" class="btn btn-primary btn-sm">Pinjam</a>
                                        <div class="d-flex">
                                            <div class="bookmark-icon mr-2">
                                                <a href="#" class="" onclick="tambahKeKoleksi(<?= $b['BukuID']; ?>)">
                                                    <i class="far fa-bookmark text-dark"></i>
                                                </a>
                                            </div>
                                            <div class="rating-icon">
                                                <a href="#" class="" onclick="showRatingModal(<?= $b['BukuID']; ?>)">
                                                    <i class="far fa-star text-warning"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (isset($b['reviewed']) && $b['reviewed']) : ?>
                                        <div class="card-footer">
                                            <p class="text-success mt-2">Anda sudah memberikan ulasan</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>



            </div>

            <!-- Modal untuk memberikan rating -->
            <div id="ratingModal" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Beri Rating</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Placeholder untuk rating -->
                            <div id="ratingStars">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Simpan</button>
                        </div>
                    </div>
                </div>
            </div> <!-- /.container-fluid -->

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

<!-- Script untuk menampilkan modal saat ikon bintang diklik -->
<script>
    function showRatingModal(bookId) {
        // Mendapatkan modal
        var modal = document.getElementById('ratingModal');

        // Menampilkan modal
        modal.style.display = 'block';
    }
</script>

<!-- Script untuk menutup modal saat tombol close atau area luar modal diklik -->
<script>
    // Dapatkan modal
    var modal = document.getElementById('ratingModal');

    // Saat pengguna mengklik di luar modal, tutup modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Saat pengguna mengklik tombol close, tutup modal
    var closeBtn = document.querySelector(".close");
    closeBtn.onclick = function() {
        modal.style.display = "none";
    };
</script>

<?= $this->endSection(); ?>