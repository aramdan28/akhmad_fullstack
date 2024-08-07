<?= $this->extend('template/front_master') ?>

<?= $this->section('styles'); ?>


<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<script>
    if (id_user != undefined) {
        location.href = "./";
    }
</script>

<div class="hero-slider-wrapper bg-dark py-16">
    <section class="wrapper bg-dark angled lower-start">
        <div class="container pt-7 pt-md-11 pb-8">
            <div class="row gx-0 gy-10 align-items-start">
                <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 text-white mb-4">RSUD SUBANG <br /><span class="typer text-success text-nowrap" data-delay="100" data-words="Mitra Sehati Menuju Sehat"></span><span class="cursor text-success" data-owner="typer"></span></h1>
                    <p class="lead fs-24 lh-sm text-white mb-3 pe-md-18 pe-lg-0 pe-xxl-15">Belum memiliki akun?</p>
                    <div>
                        <a class="btn btn-lg btn-primary rounded" href="<?= base_url() ?>sign-up">Daftar disini</a>

                    </div>
                </div>
                <!-- /column -->
                <div class="col-lg-5 offset-lg-1 mb-n18" data-cues="slideInDown">
                    <div class="position-relative">
                        <div class="card">
                            <div class="card-header pb-1">
                                <h5 class="text-dark">Masuk Sebagai Pasien</h5>
                                <small class="text-danger">* Kolom harus diisi</small>
                            </div>
                            <div class="card-body pt-3">
                                <form id="loginForm">
                                    <div class="form-floating mb-4">
                                        <input id="loginEmail" type="email" class="form-control" placeholder="Masukan Email">
                                        <label for="loginEmail">Email<label class="text-danger">*</label></label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input id="loginPassword" type="password" class="form-control" placeholder="Masukan password">
                                        <label for="loginPassword">password<label class="text-danger">*</label></label>
                                    </div>
                                    <button type="submit" class="btn btn-success">Masuk</button>
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
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;

        if (email == '' || password == '') {
            toastr.error('isi semua kolom');
            return false;
        }
        const response = await fetch(url_host + 'login', {
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

        if (data.error == undefined && data.token) {
            localStorage.setItem('token', data.token);
            localStorage.setItem('id_user', data.id_user);
            localStorage.setItem('id_role', data.id_role);
            toastr.success('Berhasil masuk');

            setTimeout(function() {
                if (localStorage.id_role != '3') {
                    location.href = "./administrator"

                } else {
                    location.href = "./"
                }
            }, 3000);

        } else {

            toastr.error(data.messages.error);
        }
    });
</script>


<?= $this->endSection() ?>