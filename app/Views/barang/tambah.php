<?= $this->extend('layout/templateadmin'); ?>
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Barang</h2>
            <!--Validation Flash data ditampilin, pake cara kayak daftar komik -->

            <form action="<?= base_url('/admin/save'); ?>" method="post" enctype="multipart/form-data">

                <?= csrf_field(); ?> <!-- Agar form tidak diinput dari mpihak ketiga -->

                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('nama_barang') ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" value="<?= old('nama_barang'); ?>" autofocus>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('nama_barang'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('harga') ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('harga'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="genre" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('stok') ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= old('stok'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('stok'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sinopsis" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= validation_show_error('deskripsi') ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" rows="6"><?= old('deskripsi'); ?></textarea>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('deskripsi'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="mb-3">
                            <div class="custom-file">
                                <label for="gambar" class="form-label"></label>
                                <input class="form-control <?= validation_show_error('gambar') ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= validation_show_error('gambar'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-secondary btn-gold">Tambah Data</button>

            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>