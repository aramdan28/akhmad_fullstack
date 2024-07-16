<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() ?>favicon.ico">
    <!--plugins-->
    <link href="<?= base_url() ?>assets_admin/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>assets_admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/css/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <!-- loader-->
    <link href="<?= base_url() ?>assets_admin/css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="<?= base_url() ?>assets_admin/css/dark-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/css/light-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/css/semi-dark.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets_admin/css/header-colors.css" rel="stylesheet" />

    <title>RSUD Subang - <?= $title ?></title>


    <?= $this->renderSection('styles') ?>

    <script>
        var url_host = 'http://localhost:8080/';
        var id_user = localStorage.id_user;
        var id_role = localStorage.id_role;

        if (id_user == undefined || id_role == '3') {
            location.href = "./";
        }
    </script>
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">


        <?= $this->include('template/admin_topbar'); ?>
        <?= $this->include('template/admin_sidebar'); ?>

        <!--start content-->
        <main class="page-content">
            <?= $this->renderSection('content') ?>
        </main>
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->



    </div>
    <!--end wrapper-->


    <!-- Bootstrap bundle JS -->
    <script src="<?= base_url() ?>assets_admin/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url() ?>assets_admin/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?= base_url() ?>assets_admin/js/pace.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/chartjs/js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <!--app-->
    <script src="<?= base_url() ?>assets_admin/js/app.js"></script>
    <script src="<?= base_url() ?>assets_admin/js/index2.js"></script>
    <script>
        new PerfectScrollbar(".best-product")
    </script>




    <?= $this->renderSection('script') ?>

    <script>
        function logout() {

            localStorage.removeItem("token");
            localStorage.removeItem("id_user");
            localStorage.removeItem("id_role");
            setTimeout(function() {
                location.href = "./"
            }, 1000);
        }
    </script>
</body>

</html>