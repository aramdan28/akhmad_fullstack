<header class="wrapper bg-soft-primary">
    <nav class="navbar navbar-expand-lg center-nav transparent position-absolute navbar-dark caret-none">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <a href="<?= base_url() ?>index.html">
                    <img class="logo-dark" src="<?= base_url() ?>assets/img/logo.svg" srcset="<?= base_url() ?>assets/img/logo.svg 2x" width="100" alt="" />
                    <img class="logo-light rounded p-1" src="<?= base_url() ?>assets/img/logo.svg" srcset="<?= base_url() ?>assets/img/logo.svg 2x" alt="" width="100" style="background: #fff8;" />
                </a>
            </div>
            <div class="navbar-collapse offcanvas-nav">
                <div class="offcanvas-header d-lg-none d-xl-none">
                    <a href="<?= base_url() ?>index.html"><img src="<?= base_url() ?>assets/img/logo.svg" srcset="<?= base_url() ?>assets/img/logo.svg 2x" alt="" /></a>
                    <button type="button" class="btn-close btn-close-white offcanvas-close offcanvas-nav-close" aria-label="Close"></button>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link" href="<?= base_url() ?>#schedule">Jadwal Dokter</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>#about">Tentang Kami</a>
                    <li id="nav-logout" class="nav-item"><a class="nav-link" href="<?= base_url() ?>sign-in">Masuk</a>
                    </li>
                    <li id="nav-logout" class="nav-item"><a class="nav-link" href="<?= base_url() ?>sign-up">Daftar</a>
                    </li>

                    <li id="nav-login" class="nav-item d-block d-lg-none "><a class="nav-link" href="<?= base_url() ?>sign-up">Profile</a>
                    </li>
                    <li id="nav-login" class="nav-item d-block d-lg-none " onclick="logout()"><a class="nav-link" href="#">Keluar</a>
                    </li>

                </ul>
                <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-other w-100 d-flex ms-auto">
                <ul class="navbar-nav flex-row align-items-center ms-auto" data-sm-skip="true">
                    <li id="nav-profile" class="nav-item dropdown language-select d-none d-lg-block ">
                        <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-user"></i></a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="dropdown-item" href="#">Profile</a></li>
                            <li class="nav-item" onclick="logout()"><a class="dropdown-item" href="#">Keluar</a></li>

                        </ul>
                    </li>
                    <li class="nav-item dropdown language-select text-uppercase">
                        <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">En</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="dropdown-item" href="#">En</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="#">De</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="#">Es</a></li>
                        </ul>
                    </li>
                    <li class="nav-item d-lg-none">
                        <div class="navbar-hamburger"><button class="hamburger animate plain" data-toggle="offcanvas-nav"><span></span></button></div>
                    </li>
                </ul>
                <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>