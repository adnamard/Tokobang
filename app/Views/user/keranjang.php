<?= $this->extend('layout/templateuser'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <h1 class="mb-4">Keranjang Belanja</h1>

    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php elseif (session()->has('error')) : ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($keranjang)) : ?>
        <div class="alert alert-info">
            Keranjang kosong, silahkan pilih barang terlebih dahulu.
        </div>
    <?php else : ?>
        <div class="row">
            <?php foreach ($keranjang as $item) : ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="/img/<?= $item['gambar']; ?>" class="card-img" alt="<?= $item['nama_barang']; ?> Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $item['nama_barang'] ?></h5>
                                    <p class="card-text"><strong>Harga:</strong> Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                                    <p class="card-text"><strong>Jumlah:</strong> <?= $item['jumlah'] ?></p>
                                    <p class="card-text"><strong>Subtotal:</strong> Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></p>
                                </div>
                                <div class="card-footer">
                                    <a href="<?= base_url('keranjang/delete/' . $item['id']) ?>" class="btn btn-outline-danger btn-sm">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-4">
            <h5>Total Belanja: Rp <?= number_format($totalHarga, 0, ',', '.') ?></h5>
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#confirmBayarModal">Bayar</button>
        </div>
    <?php endif; ?>
</div>

<!-- Modal for Confirmation -->
<div class="modal fade" id="confirmBayarModal" tabindex="-1" aria-labelledby="confirmBayarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmBayarModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah kamu ingin melakukan pembayaran?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" onclick="pembayaranCekDulu()">Cek Dulu</button>
                <button type="button" class="btn btn-outline-dark" id="confirmBayarBtn">Ya</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Payment Form -->
<div class="modal fade" id="paymentFormModal" tabindex="-1" aria-labelledby="paymentFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/keranjang/bayar" method="post" enctype="multipart/form-data" id="paymentForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentFormModalLabel">Form Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Silakan transfer ke rekening AN. <b>TokoBangunanMajuJaya 15210291 BCA</b></p>
                    <p>Jumlah yang harus dibayar: Rp <?= number_format($totalHarga, 0, ',', '.') ?></p>
                    <div class="form-group mb-3">
                        <label for="bukti_pembayaran">Bukti Transfer (Jpg/Jpeg)</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-file"></i>
                            </span>
                            <input type="file" class="form-control-file" id="bukti_pembayaran" name="bukti_pembayaran" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-outline-dark">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Handle form submission when "Ya" button is clicked
    document.getElementById('confirmBayarBtn').addEventListener('click', function() {
        // Show payment form modal
        $('#confirmBayarModal').modal('hide'); // Hide confirmation modal
        $('#paymentFormModal').modal('show'); // Show payment form modal
    });

    // Handle redirection when "Cek Dulu" button is clicked
    function pembayaranCekDulu() {
        window.location.href = '/keranjang';
    }
</script>

<?= $this->endSection(); ?>