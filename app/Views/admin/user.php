<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col text-center mb-3">
            <h1>Daftar User</h1>
        </div>
    </div>
    <div class="row">
        <div class="col text-center" style="border-radius: 50px;">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nomor</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($user as $user) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['role']; ?></td>
                            <td>
                                <div class=" row my-1">
                                    <button type="button" class="btn btn-outline-dark" onclick="detailtransaksi()">
                                        Detail
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>