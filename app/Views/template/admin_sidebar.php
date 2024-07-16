<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?= base_url() ?>assets/img/logo-rsud1.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text"> <img src="<?= base_url() ?>assets/img/logo-rsud2.png" alt="logo icon">
            </h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="<?= base_url(); ?>administrator" class="">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>
        <li>
            <a href="<?= base_url() ?>administrator/patients">
                <div class="parent-icon"><i class="bi bi-person-lines-fill"></i>
                </div>
                <div class="menu-title">Pasien</div>
            </a>
        </li>

        <li>
            <a href="<?= base_url() ?>administrator/doctors">
                <div class="parent-icon"><i class="bx bx-donate-heart"></i>
                </div>
                <div class="menu-title">Dokter</div>
            </a>
        </li>
        <li>
            <a href="<?= base_url() ?>administrator/doctor-schedule">
                <div class="parent-icon"><i class="bx bx-calendar-star"></i>
                </div>
                <div class="menu-title">Jadwal Dokter</div>
            </a>
        </li>

        <li>
            <a href="<?= base_url() ?>administrator/inspection-schedule">
                <div class="parent-icon"><i class="bx bx-calendar-exclamation"></i>
                </div>
                <div class="menu-title">Jadwal Pemeriksa</div>
            </a>
        </li>







    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->