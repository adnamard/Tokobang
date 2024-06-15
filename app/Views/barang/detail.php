<?= $this->extend('layout/templateadmin'); ?>
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Detail Barang</h2>
            <div class="card mb-3" style="border-radius: 50px; width: 750px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $barang['gambar']; ?>" class="img-fluid rounded-start" alt="..." style="border-radius: 50px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="display: grid; grid-template-columns: 1fr;">
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <div style="display: flex;">
                                    <div style="width: 120px;">Nama Barang</div>
                                    <div>: <?= $barang['nama_barang']; ?></div>
                                </div>
                                <div style="display: flex;">
                                    <div style="width: 120px;">Harga</div>
                                    <div>: <?= $barang['harga']; ?></div>
                                </div>
                                <div style="display: flex;">
                                    <div style="width: 120px;">Stok</div>
                                    <div>: <?= $barang['stok']; ?></div>
                                </div>
                                <div style="display: flex; flex-direction: column;">
                                    <div style="display: flex;">
                                        <div style="width: 120px;">Deskripsi</div>
                                        <div style="word-break: break-word;">:</div>
                                    </div>
                                    <div style="margin-left: 120px; margin-top: 5px;">
                                        <?= $barang['deskripsi']; ?>
                                    </div>
                                </div>

                                <div style="display: flex; gap: 10px; margin-top: 10px;">
                                    <div>
                                        <a href="/admin/edit/<?= $barang['nama_barang']; ?>" class="btn btn-outline-warning">Edit</a>
                                    </div>
                                    <div>
                                        <form action="/admin/delete/<?= $barang['id']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</button>
                                        </form>
                                    </div>
                                </div>

                                <div style="margin-top: 10px;">
                                    <a href="/listbarang" class="btn btn-outline-dark d-block mx-auto">Kembali ke daftar komik</a>
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