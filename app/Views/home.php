<?= $this->extend('layout/templateuser'); ?>

<?= $this->section('content'); ?>

<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif ?>
<div class="container mt-5 mb-10 d-flex flex-column align-items-center text-center">
    <img class="img-profile rounded-circle hover-zoom" src="/img/logo.jpg" style="max-width: 200px;">
    <div style="margin-top: 15px;">
        <h1 style="color: gold; font-weight: bold;">Toko Bangunan Maju Jaya</h1>
    </div>
</div>

<div class="container mt-5 mb-10">
    <div class="row">

        <?php foreach ($barang as $index => $item) : ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 rounded">
                    <img class="card-img-top" src="/img/<?= $item['gambar']; ?>" alt="<?= $item['nama_barang']; ?> Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['nama_barang'] ?></h5>
                        <p class="card-text"><?= $item['deskripsi'] ?></p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-dark" data-toggle="modal" data-target="#detailModal<?= $index; ?>">Lihat Detail</button>
                        <?php if (session()->has('userData')) : ?>
                            <form action="<?= base_url('keranjang/add/' . $item['id']); ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-secondary btn-gold">Beli Barang</button>
                            </form>
                        <?php else : ?>
                            <button type="button" class="btn btn-outline-secondary btn-gold" data-toggle="modal" data-target="#loginModal">Beli Barang</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Detail Modal -->
            <div class="modal fade" id="detailModal<?= $index; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel<?= $index; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel<?= $index; ?>"><?= $item['nama_barang'] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img class="img-fluid mb-3" src="/img/<?= $item['gambar']; ?>" alt="<?= $item['nama_barang']; ?> Image">
                            <p><strong>Harga:</strong> <?= $item['harga']; ?></p>
                            <p><strong>Stok:</strong> <?= $item['stok']; ?></p>
                            <p><strong>Deskripsi:</strong> <?= $item['deskripsi']; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-gold" data-dismiss="modal">Tutup</button>
                            <?php if (session()->has('userData')) : ?>
                                <form action="<?= base_url('keranjang/add/' . $item['id']); ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-dark">Beli Barang</button>
                                </form>
                            <?php else : ?>
                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#loginModal">Beli Barang</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<!-- Login Prompt Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda harus login terlebih dahulu untuk membeli barang.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-gold" data-dismiss="modal">Tutup</button>
                <a href="<?= base_url('auth/halamanlogin'); ?>" class="btn btn-dark">Login</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>