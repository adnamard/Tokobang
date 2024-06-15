<?= $this->extend('layout/templateadmin'); ?>
<?= $this->section('contentadmin') ?>

<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1>Daftar Barang</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-centered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 10%;" class="text-center">Nomor</th>
                            <th scope="col" style="width: 15%;" class="text-center">Gambar</th>
                            <th scope="col" style="width: 15%;" class="text-center">Nama Barang</th>
                            <th scope="col" style="width: 15%;" class="text-center">Lainnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($barang as $b) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i++; ?></th>
                                <td class="text-center"><img src="/img/<?= $b['gambar']; ?>" alt="" class="gambar" style="width: 75px;"></td>
                                <td class="text-center"><?= $b['nama_barang']; ?></td>
                                <td class="text-center">
                                    <a href="/admin/<?= $b['nama_barang']; ?>" class="btn btn-outline-secondary">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>