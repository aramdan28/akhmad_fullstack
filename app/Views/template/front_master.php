<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
    <meta name="keywords" content="bootstrap 5, business, corporate, creative, gulp, marketing, minimal, modern, multipurpose, one page, responsive, saas, sass, seo, startup">
    <meta name="author" content="elemis">
    <title>RSUD Subang - <?= $title ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>favicon.ico">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">

    <link href="<?= base_url() ?>assets_admin/plugins/sweetalert/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_admin/plugins/toastr/toastr.min.css">

    <?= $this->renderSection('styles') ?>

    <script>
        var url_host = 'http://localhost:8080/';
        var id_user = localStorage.id_user;
        var id_role = localStorage.id_role;
    </script>

</head>

<body>
    <div class="content-wrapper">

        <?= $this->include('template/front_header'); ?>


        <?= $this->renderSection('content') ?>

    </div>

    <?= $this->include('template/front_footer'); ?>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/plugins.js"></script>
    <script src="<?= base_url() ?>assets/js/theme.js"></script>

    <script src="<?= base_url() ?>assets_admin/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/plugins/toastr/toastr.min.js"></script>
    <?= $this->renderSection('script') ?>
</body>

<script>
    if (id_user != undefined) {

        var elems1 = document.querySelectorAll("#nav-profile");

        for (let index = 0; index < elems1.length; index++) {
            elems1[index].classList.add('d-lg-block');
        }
        var elems = document.querySelectorAll("#nav-login");

        for (let index = 0; index < elems.length; index++) {
            elems[index].style.display = "block !important";
            elems[index].classList.add('d-block');
            elems[index].classList.remove('d-none');


        }
        var elems2 = document.querySelectorAll("#nav-logout");
        for (let index2 = 0; index2 < elems2.length; index2++) {
            elems2[index2].style.display = "none !important";
            elems2[index2].classList.add('d-none');

        }
    } else {

        var elems1 = document.querySelectorAll("#nav-profile");

        for (let index = 0; index < elems1.length; index++) {
            elems1[index].classList.remove('d-lg-block');
        }

        var elems = document.querySelectorAll("#nav-login");

        for (let index = 0; index < elems.length; index++) {
            elems[index].style.display = "none !important";
            elems[index].classList.remove('d-block');
            elems[index].classList.add('d-none');
        }
        var elems2 = document.querySelectorAll("#nav-logout");
        for (let index2 = 0; index2 < elems2.length; index2++) {
            elems2[index2].style.display = "block !important";
            elems2[index2].classList.remove('d-none');

        }
    }

    function logout() {

        localStorage.removeItem("token");
        localStorage.removeItem("id_user");
        localStorage.removeItem("id_role");
        setTimeout(function() {
            location.href = "./"
        }, 1000);

    }
</script>

</html>