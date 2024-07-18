<?= $this->extend('template/front_master') ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="hero-slider-wrapper bg-dark">
    <div class="hero-slider owl-carousel dots-over" data-nav="true" data-dots="true" data-autoplay="true">
        <div class="owl-slide d-flex align-items-center bg-overlay bg-overlay-400" style="background-image: url(<?= base_url() ?>assets/img/photos/bg7.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-lg-7 offset-lg-0 col-xl-6 col-xxl-5 text-center text-lg-start">
                        <h1 class="display-1 text-white mb-4">RSUD SUBANG <br /><span class="typer text-success text-nowrap" data-delay="100" data-words="Mitra Sehati Menuju Sehat"></span><span class="cursor text-success" data-owner="typer"></span></h1>
                        <p class="lead fs-24 lh-sm text-white mb-3 pe-md-18 pe-lg-0 pe-xxl-15">Belum memiliki akun?</p>
                        <div>
                        </div>
                        <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500"> <a class="btn btn-lg btn-outline-white rounded-pill" href="<?= base_url() ?>sign-up">Daftar disini</a></div>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!--/.container -->
        </div>
        <!--/.owl-slide -->
        <div class="owl-slide d-flex align-items-center bg-overlay bg-overlay-400" style="background-image: url(<?= base_url() ?>assets/img/photos/bg8.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
                        <h1 class="display-1 text-white mb-4">RSUD SUBANG <br /><span class="typer text-success text-nowrap" data-delay="100" data-words="Mitra Sehati Menuju Sehat"></span><span class="cursor text-success" data-owner="typer"></span></h1>
                        <p class="lead fs-24 lh-sm text-white mb-3 pe-md-18 pe-lg-0 pe-xxl-15">Sudah memiliki akun?</p>
                        <div>
                        </div>
                        <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500"> <a class="btn btn-lg btn-outline-white rounded-pill" href="<?= base_url() ?>sign-up">Masuk Disini</a></div>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!--/.container -->
        </div>
        <!--/.owl-slide -->
        <div class="owl-slide d-flex align-items-center bg-overlay bg-overlay-400" style="background-image: url(<?= base_url() ?>assets/img/photos/bg9.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-lg-7 offset-lg-5 col-xl-6 offset-xl-6 col-xxl-5 offset-xxl-6 text-center text-lg-start">
                        <h1 class="display-1 text-white mb-4">RSUD SUBANG <br /><span class="typer text-success text-nowrap" data-delay="100" data-words="Mitra Sehati Menuju Sehat"></span><span class="cursor text-success" data-owner="typer"></span></h1>

                        <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500"><a href="#" class="btn btn-lg btn-outline-white rounded-pill">Tentang Kami</a></div>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!--/.container -->
        </div>
        <!--/.owl-slide -->
    </div>
    <!--/.hero-slider -->
</div>
<!--/.hero-slider-wrapper -->
<section class="wrapper bg-light ">
    <div class="container py-14 py-md-16">

        <!--/.row -->
        <div class="row mb-5" id="schedule">
            <div class="col-md-10 col-xl-8 col-xxl-7 mx-auto text-center">
                <img src="<?= base_url() ?>assets/img/icons/lineal/list.svg" class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
                <h2 class="display-4 mb-4 px-lg-14">Jadwal Dokter</h2>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center mb-5">
            <table id="doctorsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Spesialisasi</th>
                        <th>Hari Kerja</th>
                        <th>Waktu Kerja</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <!--/column -->
        </div>
        <!--/.row -->

        <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-17 align-items-center">
            <div class="col-lg-6 position-relative order-lg-2">
                <div class="shape bg-dot primary rellax w-16 h-20" data-rellax-speed="1" style="top: 3rem; left: 5.5rem"></div>
                <div class="overlap-grid overlap-grid-2">
                    <div class="item">
                        <figure class="rounded shadow"><img src="<?= base_url() ?>assets/img/photos/about2.jpg" srcset="<?= base_url() ?>assets/img/photos/about2@2x.jpg 2x" alt=""></figure>
                    </div>
                    <div class="item">
                        <figure class="rounded shadow"><img src="<?= base_url() ?>assets/img/photos/about3.jpg" srcset="<?= base_url() ?>assets/img/photos/about3@2x.jpg 2x" alt=""></figure>
                    </div>
                </div>
            </div>
            <!--/column -->
            <div class="col-lg-6" id="about">
                <img src="<?= base_url() ?>assets/img/icons/lineal/megaphone.svg" class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
                <h2 class="display-4 mb-3">Who Are We?</h2>
                <p class="lead fs-lg">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum vitae dolor ut quod quibusdam? Exercitationem quo incidunt magni consequuntur asperiores aperiam dolores soluta quos, eum, quod mollitia odio illo ipsum?</p>
                <p class="mb-6">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat non dolor nemo eius ipsa repudiandae dignissimos error, in iste veniam quia earum voluptatem esse dolore illum asperiores pariatur corrupti id!</p>
                <div class="row gy-3 gx-xl-8">
                    <div class="col-xl-6">
                        <ul class="icon-list bullet-bg bullet-soft-primary mb-0">
                            <li><span><i class="uil uil-check"></i></span><span>Aenean eu leo quam ornare curabitur blandit tempus.</span></li>
                            <li class="mt-3"><span><i class="uil uil-check"></i></span><span>Nullam quis risus eget urna mollis ornare donec elit.</span></li>
                        </ul>
                    </div>
                    <!--/column -->
                    <div class="col-xl-6">
                        <ul class="icon-list bullet-bg bullet-soft-primary mb-0">
                            <li><span><i class="uil uil-check"></i></span><span>Etiam porta sem malesuada magna mollis euismod.</span></li>
                            <li class="mt-3"><span><i class="uil uil-check"></i></span><span>Fermentum massa vivamus faucibus amet euismod.</span></li>
                        </ul>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!--/column -->
        </div>
    </div>
    <!-- /.container -->
</section>

<?= $this->endSection() ?>

<?= $this->section('script'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#doctorsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "http://localhost:8080/api/doctorsall",
                "type": "GET",
                "beforeSend": function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer');
                },
                "dataSrc": function(json) {
                    // Inspect the JSON response
                    console.log(json);
                    // Ensure the data is returned in the expected format
                    if (json.data) {
                        return json.data;
                    } else {
                        return [];
                    }
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "specialization"
                },
                {
                    "data": "day"
                },
                {
                    "data": "time"
                }
            ]
        });
    });
</script>

<?= $this->endSection() ?>