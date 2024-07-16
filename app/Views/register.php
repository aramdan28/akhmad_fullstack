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
        <div class="container pt-7 pt-md-11 pb-18">
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
                            <div class="card-header pb-1">
                                <h5 class="text-dark">Daftar Sebagai Pasien</h5>
                                <small class="text-danger">* Kolom harus diisi</small>
                            </div>
                            <div class="card-body pt-3">
                                <form id="registerForm">
                                    <div class="form-floating mb-4">
                                        <input id="name" type="text" class="form-control" placeholder="Masukan nama">
                                        <label for="name">Nama Lengkap<label class="text-danger">*</label></label>
                                    </div>

                                    <div class="form-floating mb-4">
                                        <input id="age" type="number" min="1" max="100" class="form-control" placeholder="Masukan usia">
                                        <label for="age">Masukan usia<label class="text-danger">*</label></label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <textarea id="address" class="form-control" placeholder="Textarea" style="height: 150px" required></textarea>
                                        <label for="address">Masukan alamat Lengkap<label class="text-danger">*</label></label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input id="email" type="email" class="form-control" placeholder="Masukan Email">
                                        <label for="email">Masukan email<label class="text-danger">*</label></label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input id="password" type="password" class="form-control" placeholder="Masukan password">
                                        <label for="password">Masukan Kata Sandi<label class="text-danger">*</label></label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input id="cpassword" type="password" class="form-control" placeholder="Masukan ulang kata sandi">
                                        <label for="cpassword">Masukan ulang kata sandi<label class="text-danger">*</label></label>
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
        const name = document.getElementById('name').value;
        const age = document.getElementById('age').value;
        const address = document.getElementById('address').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const cpassword = document.getElementById('cpassword').value;

        if (name == '' || age == '' || address == '' || email == '' || password == '' || cpassword == '') {
            toastr.error('Isi semua kolom');
            return false
        }

        if (password != cpassword) {
            toastr.error('Kata sandi tidak sama dengan konfirmasi kata sandi');
            return false
        }

        const response = await fetch('http://localhost:8080/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name,
                age,
                address,
                email,
                password,
                cpassword,
            })
        });
        const data = await response.json();
        console.log(data);

        if (data.status == 200 && data.sts == 'ok') {
            localStorage.setItem('token', data.token);
            localStorage.setItem('id_user', data.id_user);
            localStorage.setItem('id_role', data.id_role);
            toastr.success('Berhasil mendaftar');

            setTimeout(function() {
                location.href = "./"
            }, 3000);

        } else {

            toastr.error(data.messages.error);
        }
    });
</script>


<?= $this->endSection() ?>