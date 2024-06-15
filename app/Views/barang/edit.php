<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Barang</h2>
            <!--Validation Flash data ditampilin, pake cara kayak daftar komik -->

            <form action="/admin/update/<?= $barang['id']; ?>" method="post">
                <?= csrf_field(); ?> <!-- Agar form tidak diinput dari mpihak ketiga -->

                <input type="hidden" name="slug" value="<?= $barang['nama_barang']; ?>">
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('nama_barang') ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" autofocus value="<?= (old('nama_barang')) ? old('nama_barang') : $barang['nama_barang']; ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('nama_barang'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('harga') ? 'is-invalid' : ''; ?> " id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $barang['harga']; ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('stok') ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= (old('stok')) ? old('stok') : $barang['stok']; ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('stok'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sinopsis" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= validation_show_error('deskripsi') ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" rows="4"><?= (old('deskripsi')) ? old('deskripsi') : $barang['deskripsi']; ?></textarea>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('deskripsi'); ?>
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="gambar" name="gambar" value="<?= (old('gambar')) ? old('gambar') : $barang['gambar']; ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
                <a href="/listbarang" class="btn btn-outline-dark">Kembali ke daftar komik</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>