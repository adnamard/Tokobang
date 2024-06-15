<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>
<div class="container">
    <div class="row text-center">
        <h1>Daftar Transaksi Menunggu </h1>
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
                            <?php if ($item['status_id'] == 3) : ?>
                                <div class="row my-1">
                                    <button type="button" class="btn btn-outline-warning" onclick="edittransaksi()">
                                        Edit
                                    </button>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>

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

                    <div class="modal" id="edittransaksi" tabindex=" -1" role="dialog" aria-labelledby="edittransaksiLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edittransaksiLabel<?= $item['id']; ?>">Detail Transaksi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="/pembayaran/update/<?= $item['id']; ?>" method="post" enctype="multipart/form-data" id="paymentForm">
                                    <input type="hidden" name="user_id" value="<?= $item['user_id']; ?>">
                                    <input type="hidden" name="barang_id" value="<?= $item['barang_id']; ?>">
                                    <input type="hidden" name="transaksi" value="<?= $item['transaksi']; ?>">
                                    <div class="modal-body" style="display: grid; grid-template-columns: 1fr;">
                                        <!-- Isi informasi rekening di sini -->
                                        <div class="modal-body mb-3" style="width: fit-content;">
                                            <label for="dropdown">Ubah Status:</label>
                                            <select class="form-select status_id" name="status_id" required>
                                                <!-- option pilih -->
                                                <option value="">Pilih Status</option>
                                                <?php foreach ($daftar_status as $status) : ?>
                                                    <!-- menghilangkan atau mengabaikan status "menunggu konfirmasi" -->
                                                    <?php if ($status['id'] == 3) {
                                                        continue;
                                                    } ?>
                                                    <option value="<?= $status['id']; ?>" <?= $status['id'] == $item['status_id'] ? 'selected' : ''; ?>><?= $status['status']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-dark">Simpan</button>

                                        <button type="button" class="btn btn-outline-dark" onclick="tutupdetail()">Tutup</button>
                                    </div>
                                </form>
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
                            window.location.href = "<?php echo base_url('Pembayaran/menunggu'); ?>";
                        }
                    </script>

                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>