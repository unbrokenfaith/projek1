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
            <a class="nav-link" href="/admin">
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
        <li class="nav-item active">
            <a class="nav-link" href="/admin/buku">
                <i class="fas fa-fw fa-book"></i>
                <span>Buku</span></a>
        </li>

        <!-- Nav Item - Kategori -->
        <li class="nav-item">
            <a class="nav-link" href="/admin/kategori">
                <i class="fas fa-fw fa-table"></i>
                <span>Kategori</span></a>
        </li>

        <!-- Nav Item - Petugas -->
        <li class="nav-item">
            <a class="nav-link" href="/admin/petugas">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Petugas</span></a>
        </li>


        <!-- Nav Item - Users -->
        <li class="nav-item">
            <a class="nav-link" href="/admin/user">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Riwayat Peminjaman -->
        <li class="nav-item">
            <a class="nav-link" href="/admin/riwayatpeminjaman">
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
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$username;?></span>
                            <i class="fa-solid fa-user"></i> </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=base_url('/logout');?>">
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
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/admin/buku/create" class="btn btn-outline-primary me-md-3">Tambah Data</a>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Daftar Buku</h1>
                        </div>

                        <div class="form-group dropdown w-25 no-margin-bottom">
                            <select name="kategori_filter" id="kategori_filter" class="form-select select-verif" onchange="window.location = '/buku/filter/' + this.value;">
                                <option value="">Semua Kategori</option>
                                <?php foreach ($kategori_filter as $kategori): ?>
                                    <option value="<?=$kategori['KategoriID'];?>" <?=($selectedKategori == $kategori['KategoriID']) ? 'selected' : '';?>><?=$kategori['NamaKategori'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>


                        <?php if (session()->getFlashdata('pesan')): ?>
                            <div class="alert alert-success" role="alert">
                                <?=session()->getFlashdata('pesan');?>
                            </div>
                        <?php endif;?>

                        <div class=" card shadow">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Sampul</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Penulis</th>
                                        <th scope="col">Penerbit</th>
                                        <th scope="col">Tahun Terbit</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($buku as $b): ?>
                                        <tr>
                                            <th scope="row"><?=$i++;?></th>
                                            <td><img src="/img/<?=$b['Sampul'];?>" alt="" class="sampul"></td>
                                            <td><?=$b['Judul'];?></td>
                                            <td><?=$b['NamaKategori'];?></td>
                                            <td><?=$b['Penulis'];?></td>
                                            <td><?=$b['Penerbit'];?></td>
                                            <td><?=$b['TahunTerbit'];?></td>
                                            <td><?=$b['Stok'];?></td>
                                            <td>
                                                <a href="/admin/buku/edit/<?=$b['BukuID'];?>" class="btn btn-warning">Ubah</a> |

                                                <form action="/bukucontroller/<?=$b['BukuID'];?>" method="post" class="d-inline">
                                                    <?=csrf_field();?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah Anda yakin ingin menghapus?');">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
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
    document.addEventListener('DOMContentLoaded', function() {
        const filterKategori = document.getElementById('kategori_filter');

        filterKategori.addEventListener('change', function() {
            const selectedKategori = filterKategori.value;

            // Redirect ke halaman dengan filter yang dipilih
            window.location.href = selectedKategori ? `/buku/filter/${selectedKategori}` : '/buku';
        });
    });
</script>

<?=$this->endSection();?>