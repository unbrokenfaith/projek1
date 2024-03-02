<?=$this->extend('layout/template');?>

<?=$this->section('content');?>

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
            <a class="nav-link" href="/petugas">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            DATA
        </div>

        <!-- Nav Item - Buku -->
        <li class="nav-item">
            <a class="nav-link" href="/petugas/buku">
                <i class="fas fa-fw fa-book"></i>
                <span>Buku</span></a>
        </li>

        <!-- Nav Item - Kategori -->
        <li class="nav-item">
            <a class="nav-link" href="/petugas/kategori">
                <i class="fas fa-fw fa-table"></i>
                <span>Kategori</span></a>
        </li>

        <!-- Nav Item - Users -->
        <li class="nav-item active">
            <a class="nav-link" href="/petugas/user">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Riwayat Peminjaman -->
        <li class="nav-item">
            <a class="nav-link" href="/petugas/riwayatpeminjaman">
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


                        <div class="">
                            <a href="/petugas/user" class="btn btn-outline-primary ml-3">
                                < Kembali</a>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h4 class="h3 mb-0 mt-3 text-gray-800">Tambah Data User</h4>
                        </div>
                        <div class="card p-3 shadow">
                            <form action="/userpetugas/save" method="post" enctype="multipart/form-data">
                                <?=csrf_field();?>
                                <div class="mb-3">
                                    <label for="NamaLengkap" class="form-label-f">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-user <?=(session('errNamaLengkap')) ? 'is-invalid' : '';?>" id="NamaLengkap" name="NamaLengkap" value="<?=old('NamaLengkap');?>">
                                    <?php if (session()->has('errNamaLengkap')): ?>
                                        <div class="invalid-feedback"><?=session('errNamaLengkap');?></div>
                                    <?php endif;?>
                                </div>
                                <div class="mb-3">
                                    <label for="Username" class="form-label-f">Username</label>
                                    <input type="text" class="form-control form-control-user <?=(session('errUsername')) ? 'is-invalid' : '';?>" id="Username" name="Username" value="<?=old('Username');?>">
                                    <?php if (session()->has('errUsername')): ?>
                                        <div class="invalid-feedback"><?=session('errUsername');?></div>
                                    <?php endif;?>
                                </div>
                                <div class="mb-3">
                                    <label for="Password" class="form-label-f">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-user <?=(session('errPassword')) ? 'is-invalid' : '';?>" id="Password" name="Password" value="<?=old('Password');?>">
                                        <span class="input-group-text" id="togglePassword">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>
                                    <?php if (session()->has('errPassword')): ?>
                                        <div class="invalid-feedback"><?=session('errPassword');?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <label for="Email" class="form-label-f">Email</label>
                                    <input type="text" class="form-control form-control-user <?=(session('errEmail')) ? 'is-invalid' : '';?>" id="Email" name="Email" value="<?=old('Email');?>">
                                    <?php if (session()->has('errEmail')): ?>
                                        <div class="invalid-feedback"><?=session('errEmail');?></div>
                                    <?php endif;?>
                                </div>
                                <div class="mb-3">
                                    <label for="Alamat" class="form-label-f">Alamat</label>
                                    <input type="text" class="form-control form-control-user <?=(session('errAlamat')) ? 'is-invalid' : '';?>" id="Alamat" name="Alamat" value="<?=old('Alamat');?>">
                                    <?php if (session()->has('errAlamat')): ?>
                                        <div class="invalid-feedback"><?=session('errAlamat');?></div>
                                    <?php endif;?>
                                </div>


                                <div class="gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary me-md-0">Tambah Data</button>
                                </div>
                            </form>
                        </div>
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
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#Password');

    togglePassword.addEventListener('click', function (e) {
        // Toggle icon class
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');

        // Toggle password field type
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
    });
</script>



<?=$this->endSection();?>