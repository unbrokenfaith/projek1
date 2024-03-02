<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
                        </div>

                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('/AuthController/registerProcess'); ?>" method="post" enctype="multipart/form-data" class="user">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= (session('errNamaLengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="namaLengkap" placeholder="Nama Lengkap">
                                <?php if (session()->has('errNamaLengkap')) : ?>
                                    <div class="invalid-feedback"><?= session('errNamaLengkap'); ?></div>
                                <?php endif; ?>

                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user <?= (session('errEmail')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email">
                                <?php if (session()->has('errEmail')) : ?>
                                    <div class="invalid-feedback"><?= session('errEmail'); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= (session('errAlamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" placeholder="Alamat">
                                <?php if (session()->getFlashdata('errAlamat')) {
                                    echo '<div class="invalid-feedback text-start">' . session()->getFlashdata('errAlamat') . ' </div>';
                                } ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= (session('errUsername')) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Username">
                                <?php if (session()->getFlashdata('errUsername')) {
                                    echo '<div class="invalid-feedback text-start">' . session()->getFlashdata('errUsername') . ' </div>';
                                } ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user <?= (session('errPassword')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                                    <?php if (session()->getFlashdata('errPassword')) {
                                        echo '<div class="invalid-feedback text-start">' . session()->getFlashdata('errPassword') . ' </div>';
                                    } ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user <?= (session('errRepassword')) ? 'is-invalid' : ''; ?>" id="repassword" name="repassword" placeholder="Ulangi Password">
                                    <?php if (session()->getFlashdata('errRepassword')) {
                                        echo '<div class="invalid-feedback text-start">' . session()->getFlashdata('errRepassword') . ' </div>';
                                    } ?>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Daftarkan Akun</button>
                            </div>
                            <hr>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="/">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>