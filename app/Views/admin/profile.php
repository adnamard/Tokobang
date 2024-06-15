<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>
<div class="container" style="width: auto;">
    <h1>Profile Admin</h1>
    <div class="card" style="border-radius:50px;width:550px">
        <div class=" row g-0">
            <div class="col-md-4 mb-10" style="width:auto;border-radius:70px;">
                <img src="/img/user.png" class=" img-fluid" style="max-width: 100px; border-radius:50px;" alt="...">
            </div>
            <div class="col-md-8 ">
                <div class="card-body">
                    <p><strong>Username: <?php echo $user['username']; ?></strong></p>
                    <p>Email: <?php echo $user['email']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>