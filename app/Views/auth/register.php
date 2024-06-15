<?= $this->extend('layout/templateauth'); ?>

<?= $this->section('content'); ?>

<div class="container-auth">
    <div class="auth-form">
        <div class="row">
            <div class="col">
                <?= csrf_field(); ?>

                <form action="/auth/register" method="POST">
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <a href="<?= base_url('/'); ?>">
                            <img class="img-profile rounded-circle hover-zoom" src="/img/logo.jpg" style="max-width: 50px;">
                        </a>
                    </div>
                    <div class="form-tittle">
                        <h1 style="display: flex; align-items: center; justify-content: center;">Register</h1>
                    </div>

                    <?php if (session()->getFlashdata('pesangagal')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('pesangagal') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('pesansukses')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesansukses') ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" aria-describedby="emailHelp" placeholder="Masukkan username" name="username" value="<?= old('username') ?>" autofocus class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" aria-describedby="emailHelp" placeholder="Masukkan Email" name="email" value="<?= old('email') ?>" autofocus class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" placeholder="Masukkan Password" value="<?= old('password') ?>" name="password" class="form-control">
                    </div>

                    <div class="text-center">
                        <input type="submit" name="login" class="btn btn-dark mt-4" value="Sign Up">
                        <p style="margin-top: 6px">Sudah punya akun? <a href="<?= base_url('auth/halamanlogin'); ?>">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>