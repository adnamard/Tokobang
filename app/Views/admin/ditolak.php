<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row text-center">

        <h1>Daftar Transaksi Ditolak </h1>
    </div>
    <div class="col justify-content-center">
        <table class="table">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Id</th>
                    <th scope="col">Barang</th>
                    <th scope="col">User</th>
                    <th scope="col">Transaksi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Pembelian</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tableData">

                <?php $i = 1; ?>
                <?php foreach ($daftar_status_pembelian as $index => $item) : ?>
                    <tr class="text-center">
                        <th scope="row" class="text-center"><?= $i++; ?></th>
                        <td><?= $item['id']; ?></td>
                        <td><?= $item['nama_barang']; ?></td>
                        <td><?= $item['username']; ?></td>
                        <td><?= $item['transaksi']; ?></td>
                        <td><?= $item['status']; ?></td>
                        <td><?= $item['tanggal_pembelian']; ?></td>
                        <td>
                            <div class=" row my-1">
                                <button type="button" class="btn btn-outline-dark" onclick="detailtransaksi()">
                                    Detail
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

                <div class="modal" id="detailtransaksi" tabindex="-1" role="dialog" aria-labelledby="detailtransaksiLabel" aria-hidden="true">
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

                                    <div style="position: absolute; top: 10px; right: 10px;">
                                        <img src="/img/<?= $item['bukti_pembayaran']; ?>" alt="bukti_pembayaran" style="max-width: 150px; max-height: 150px;">
                                        <div style="display: flex; flex-direction: column; justify-content: center;">
                                            <h6 style="font-size: 14px; margin: 0;">Bukti Pembayaran</h6>
                                        </div>
                                    </div>
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

                <script>
                    function detailtransaksi() {
                        $('#detailtransaksi').modal('show');
                    }

                    function edittransaksi() {
                        $('#edittransaksi').modal('show');
                    }

                    function tutupdetail() {
                        window.location.href = "<?php echo base_url('Pembayaran/ditolak'); ?>";
                    }
                </script>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>