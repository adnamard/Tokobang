<nav class="navbar navbar-expand-lg navbar-light bg-dark" style="display: flex; justify-content: center;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: center;">
        <?php if (session()->has('userData')) : ?>
            <!-- If user is logged in -->
            <ul class="navbar-nav" style="flex-direction: row;">
                <li class="nav-item active" style="padding: 0 10px;">
                    <a class="nav-link" href="<?= base_url('/'); ?>" style="color: gold; font-weight: bold;">Home</a>
                </li>
                <li class="nav-item" style="padding: 0 10px;">
                    <a class="nav-link" href="<?= base_url('keranjang/'); ?>" style="color: gold; font-weight: bold;">Keranjang</a>
                </li>
                <li class="nav-item dropdown ms-auto" style="padding-right: 3cm;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: gold; font-weight: bold;">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('datakeranjang'); ?>">Riwayat Peminjaman</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        <?php else : ?>
            <!-- If user is not logged in -->
            <ul class="navbar-nav" style="flex-direction: row;">
                <li class="nav-item active" style="padding: 0 10px;">
                    <a class="nav-link" href="<?= base_url('/'); ?>" style="color: gold; font-weight: bold;">Home</a>
                </li>
                <li class="nav-item" style="padding: 0 10px;">
                    <a class="nav-link" href="<?= base_url('auth/halamanlogin'); ?>" style="color: gold; font-weight: bold;">Login</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>