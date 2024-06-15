<?= $this->extend('layout/templateuser'); ?>

<?= $this->section('content'); ?>
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<div class="container-client">
    <div class="row-client">
        <div class="col" style="width:auto">
            <h3 style="display: flex;justify-content: center;align-items: center;margin-bottom:3">Riwayat Pembelian</h3>
            <br></br>

            <?php
            // Array untuk data bayar_keberapa sebagai kunci
            $dataPerBayarKeberapa = [];

            // Mengelompokkan data berdasarkan bayar_keberapa
            foreach ($riwayatTransaksi as $item) {
                $transaksi = $item['transaksi'];
                $dataPerBayarKeberapa[$transaksi][] = $item;
            }
            ?>

            <?php foreach ($dataPerBayarKeberapa as $transaksi => $items) : ?>
                <?php foreach ($items as $item) : ?>
                    <h4>Transaksi-<?= $transaksi ?></h4>
                    <div class="card mb-3" style="border-radius: 50px;">
                        <div class="row g-0" style="width: 650px;">
                            <div class="col-md-4" style="width: auto; border-radius: 70px;">
                                <img src="/img/<?= $item['bukti_pembayaran']; ?>" class="img-fluid" style="max-width: 200px; border-radius: 50px;" alt="...">
                            </div>
                            <div class="col-md-8" style="padding-left: 10px;">
                                <div class="card-body">
                                    <div style="margin-bottom: 10px;">
                                        <p class="card-text">Nama : <?= $item['username']; ?></p>
                                        <p class="card-text">Email : <?= $item['email']; ?></p>
                                    </div>
                                    <div style="margin-bottom: 10px;">
                                        <p>-- Komik yang Dibeli --</p>
                                        <p class="card-text">Nama Barang : <?= $item['nama_barang']; ?></p>
                                        <p class="card-text">Harga Barang : <?= $item['harga']; ?></p>
                                    </div>
                                    <div style="margin-bottom: 10px;">
                                        <p class="mb-2">
                                            <strong>Status:</strong>
                                            <span class="<?= getStatusColorClass($item['status_id']); ?> p-1 rounded"><?= $item['status']; ?></span>
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-outline-dark" style="position: absolute; bottom: 15px; right: 25px; border-radius: 75px;" onclick="detailtransaksi(<?= $item['id'] ?>)" data-toggle="modal" data-target="#detailtransaksi<?= $item['id'] ?>">
                                        Detail
                                    </button>
                                </div>
                                <div class="modal" id="detailtransaksi<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailtransaksiLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailtransaksiLabel">Detail Transaksi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>


                                            <div class="modal-body" style="display: grid; grid-template-columns: 1fr;">
                                                <!-- Isi informasi rekening di sini -->
                                                <div class="modal-body" style="display: flex; flex-direction: column; gap: 10px;">
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">ID </div>
                                                        <div>: <?= $item['id']; ?></div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">Username </div>
                                                        <div>: <?= $item['username']; ?></div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">Email </div>
                                                        <div>: <?= $item['email']; ?></div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">Transaksi ke- </div>
                                                        <div>: <?= $item['transaksi']; ?></div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 250px;">-= Barang yang Dibeli =-</div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">Judul </div>
                                                        <div>: <?= $item['nama_barang']; ?></div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">Harga </div>
                                                        <div>: <?= $item['harga']; ?></div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">Jumlah </div>
                                                        <div>: <?= $item['jumlah']; ?></div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">Status </div>
                                                        <div>: <?= $item['status']; ?></div>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <div style="width: 120px;">Tanggal Pembelian </div>
                                                        <div>: <?= $item['tanggal_pembelian']; ?></div>
                                                    </div>

                                                    <div style="display:flex">
                                                        <img src="/img/<?= $item['bukti_pembayaran']; ?>" alt="bukti_pembayaran" style="max-width: 150px; max-height: 150px;">

                                                    </div>
                                                    <h6 style="font-size: 14px; margin: 0;">Bukti Pembayaran</h6>
                                                    <!-- Lanjutkan dengan baris-baris lainnya -->
                                                </div>

                                                <!-- Ganti informasi di atas sesuai kebutuhan -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-dark" onclick="tutupdetail()">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php endforeach ?>


            <?php endforeach ?>



        </div>
    </div>
</div>

<script>
    function detailtransaksi(transactionId) {
        $('#detailtransaksi' + transactionId).modal('show');
    }

    function tutupdetail() {
        window.location.href = "<?php echo base_url('DataCheckout/'); ?>";
    }
</script>

<?php
function getStatusColorClass($status)
{
    switch ($status) {
        case 1:
            return 'bg-warning'; // Warna kuning
        case 2:
            return 'bg-success'; // Warna hijau
        case 3:
            return 'bg-danger'; // Warna merah
        default:
            return ''; // Warna default
    }
}
?>

<?= $this->endSection(); ?>