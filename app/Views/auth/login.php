<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back to Perpustakaan</h1>
                                </div>
                                <form action="<?= base_url('/AuthController/loginProcess'); ?>" method="post" enctype="multipart/form-data" class="user">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                                        <?php if (session()->has('errUsername')) : ?>
                                            <div class="invalid-feedback"><?= session('errUsername'); ?></div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?php if (session()->has('errPassword')) : ?>
                                            <div class="invalid-feedback"><?= session('errPassword'); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (session()->has('errMsg')) : ?>
                                        <div class="invalid-feedback"><?= session('errMsg'); ?></div>
                                    <?php endif; ?>
                                    <!-- <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div> -->
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </div>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="/register">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>



<?= $this->endSection(); ?>