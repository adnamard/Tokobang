<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Main Wrapper -->
            <div class="p-1 my-container active-cont my-5">
                <div class="container-fluid">
                    <div class="my-4">
                        <?php if (session()->has('success')) : ?>
                            <div class="alert alert-success">
                                <?= session('success') ?>
                            </div>
                        <?php elseif (session()->has('error')) : ?>
                            <div class="alert alert-danger">
                                <?= session('error') ?>
                            </div>
                        <?php endif; ?>

                        <div class="row mt-0" id="welcomeText" style="opacity: 0;">
                            <h1 style='font-family: "Times New Roman", Times, serif;'>
                                Hallo <?= isset($user['username']) ? $user['username'] : 'Guest' ?>, Selamat Datang di Dashboard
                            </h1>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var opacity = 0;
                    var element = document.getElementById("welcomeText");
                    var interval = setInterval(function() {
                        opacity += 0.01; // Peningkatan sebesar 0.01 setiap milidetik
                        element.style.opacity = opacity;
                        if (opacity >= 1) {
                            clearInterval(interval);
                        }
                    }, 1); // Interval per milidetik (1 milidetik)
                });
            </script>



            <!-- <script>
    document.addEventListener("DOMContentLoaded", function() {

        setTimeout(function() {
            document.getElementById("card1").style.opacity = "1";
        }, 1500); // Delay selama 1 detik (1000 milidetik)

        setTimeout(function() {
            document.getElementById("card2").style.opacity = "1";
        }, 2000); // Delay selama 1.5 detik (1500 milidetik)

        setTimeout(function() {
            document.getElementById("card3").style.opacity = "1";
        }, 2500); // Delay selama 2 detik (2000 milidetik)

        setTimeout(function() {
            document.getElementById("card4").style.opacity = "1";
        }, 3000); // Delay selama 2.5 detik (2500 milidetik)
    });
</script> -->
        </div>
    </div>
</div>
<?= $this->endSection(); ?>