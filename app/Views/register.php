<?= $this->extend('template/front_master') ?>

<?= $this->section('styles'); ?>


<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="hero-slider-wrapper bg-dark py-16">
    <section class="wrapper bg-dark angled lower-start">
        <div class="container pt-7 pt-md-11 pb-8">
            <div class="row gx-0 gy-10 align-items-start">
                <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 text-white mb-4">RSUD SUBANG <br /><span class="typer text-success text-nowrap" data-delay="100" data-words="Mitra Sehati Menuju Sehat"></span><span class="cursor text-success" data-owner="typer"></span></h1>
                    <p class="lead fs-24 lh-sm text-white mb-3 pe-md-18 pe-lg-0 pe-xxl-15">Sudah memiliki akun?</p>
                    <div>
                        <a class="btn btn-lg btn-primary rounded" href="<?= base_url() ?>sign-in">Masuk disini</a>
                    </div>
                </div>
                <!-- /column -->
                <div class="col-lg-5 offset-lg-1 mb-n18" data-cues="slideInDown">
                    <div class="position-relative">
                        <div class="card">
                            <div class="card-body">
                                <form id="registerForm">
                                    <div class="form-floating mb-4">
                                        <input id="email" type="email" class="form-control" placeholder="Masukan Email">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input id="password" type="password" class="form-control" placeholder="Masukan password">
                                        <label for="password">password</label>
                                    </div>
                                    <button type="submit" class="btn btn-success">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /div -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
</div>

<?= $this->endSection() ?>
<?= $this->section('script'); ?>

<script>
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const response = await fetch('http://localhost:8080/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email,
                password
            })
        });
        const data = await response.json();
        console.log(data);
    });
</script>


<?= $this->endSection() ?>