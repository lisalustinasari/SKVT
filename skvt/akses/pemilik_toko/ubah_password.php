<?php
date_default_timezone_set("Asia/Jakarta");
include('../../cfg/config.php');
$lib = new config();
session_start();
if (isset($_SESSION['id_akses'])) {
    $set_akses = $_SESSION['id_akses'];
    $get_akses = $lib->get_akses($set_akses);
    $get_profile = $lib->get_profile($set_akses);
    if (!isset($get_akses["email"]) && !isset($get_akses["hak_akses"])) {
        echo "<script type='text/javascript'>alert('Anda Harus Login Terlebih Dahulu!');window.location.href = '../../index';</script>";
        exit;
    }

    $aks = $get_akses["hak_akses"];

    if ($aks != "pemilik_toko") {
        echo "<script type='text/javascript'>alert('Anda Tidak Memiliki Akses Petugas!');window.location.href = '../../index';</script>";
        exit;
    }
} else {
    header('Location: ../../index');
}

if (isset($_GET['id'])) {
    $kd = $_GET['id'];
    $data_karyawan = $lib->get_by_id_karyawan($kd);
    if (!!!$data_karyawan) {
        echo "<script type='text/javascript'>alert('id karyawan tidak di temukan di database!');window.location.href = 'informasi_karyawan';</script>";
    }
}

if (isset($_POST['simpan'])) {
    $copass = md5($_POST['copass']);
    $passx = md5($_POST['passwordx']);

    if ($copass === $passx) {
        $idx_akses = $_POST['id_akses'];
        $add_status = $lib->ubahPasswordKaryawan($idx_akses, $passx);
        if ($add_status) {
            echo "<script type='text/javascript'>alert('Berhasil Mengubah Password Karyawan!');window.location.href = 'informasi_karyawan';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Gagal Mengubah Password Karyawan!');window.location.href = 'ubah_password_p?id=" . $data_karyawan['id_akses_login'] . "';</script>";
        }
    } else {
        $error = '
                <div class="mb-3">
                <div class="alert alert-danger bg-danger text-white rounded" style="color:white" role="alert">
                <strong>Gagal Menambahkan Data Karyawan!</strong> Password dengan Confirm Password tidak sama!
                </div>
                </div>
            ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SKVT - Ubah Password Karyawan</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../../assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['../../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../../assets/css/demo.css">
</head>

<body>
    <div class="wrapper static-sidebar">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="home" class="logo">
                    <img src="../../assets/img/LogoAT2.png" height="38" width="136" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fas fa-layer-group"></i>
                            </a>
                            <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                                <div class="quick-actions-header">
                                    <span class="title mb-1">Quick Actions</span>
                                    <span class="subtitle op-8">Shortcuts</span>
                                </div>
                                <div class="quick-actions-scroll scrollbar-outer">
                                    <div class="quick-actions-items">
                                        <div class="row m-0">
                                            <a class="col-6 col-md-4 p-0" href="karyawan">
                                                <div class="quick-actions-item">
                                                    <i class="flaticon-users"></i>
                                                    <span class="text">Tambah Karyawan</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <i class="flaticon-down-arrow-2 text-success"></i>
                                                    <span class="text">Catat Pemasukan</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="pengeluaran">
                                                <div class="quick-actions-item">
                                                    <i class="flaticon-arrows text-danger"></i>
                                                    <span class="text">Catat Pengeluaran</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="transaksi">
                                                <div class="quick-actions-item">
                                                    <i class="far fa-handshake"></i>
                                                    <span class="text">Catat Transaksi</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <i class="flaticon-file"></i>
                                                    <span class="text">Cetak Struk</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <i class="flaticon-file-1"></i>
                                                    <span class="text">Laporan</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="../../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img src="../../assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4><?= $get_profile['nama_pemilik']; ?></h4>
                                                <p class="text-muted"><?= $get_profile['email']; ?></p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <a class="dropdown-item" href="#">My Balance</a>
                                        <a class="dropdown-item" href="#">Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../../cfg/logout">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <div class="classic-grid">
            <!-- Sidebar -->
            <div class="sidebar sidebar-style-2">
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <div class="user">
                            <div class="avatar-sm float-left mr-2">
                                <img src="../../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="info">
                                <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                    <span>
                                        <?= $get_profile['nama_pemilik']; ?>
                                        <span class="user-level text-capitalize"><?= $result = preg_replace("/[^a-zA-Z]/", " ", $get_akses["hak_akses"]); ?></span>
                                        <span class="caret"></span>
                                    </span>
                                </a>
                                <div class="clearfix"></div>

                                <div class="collapse in" id="collapseExample">
                                    <ul class="nav">
                                        <li>
                                            <a href="#profile">
                                                <span class="link-collapse">My Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#edit">
                                                <span class="link-collapse">Edit Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#settings">
                                                <span class="link-collapse">Settings</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-primary">
                            <li class="nav-item">
                                <a href="home">
                                    <i class=" fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#base">
                                    <i class="fas fa-clipboard-list"></i>
                                    <p>Pencatatan</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="base">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="components/avatars.html">
                                                <span class="sub-item text-success font-weight-bold mr-2">Pemasukan</span> <span class="fa fa-exchange-alt text-success"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components/buttons.html">
                                                <span class="sub-item text-danger font-weight-bold mr-2">Pengeluaran</span> <span class="fa fa-exchange-alt text-danger"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a data-toggle="collapse" href="#sidebarLayouts">
                                    <i class="fas fa-users"></i>
                                    <p>Karyawan</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse show" id="sidebarLayouts">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="karyawan">
                                                <span class="sub-item">Tambah Karyawan</span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="informasi_karyawan">
                                                <span class="sub-item">Informasi Karyawan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#forms">
                                    <i class="fas fa-handshake"></i>
                                    <p>Transaksi</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="forms">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="transaksi">
                                                <span class="sub-item">Catat Transaksi</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="informasi_transaksi">
                                                <span class="sub-item">Informasi Transaksi</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#tables">
                                    <i class="fas fa-user-tie"></i>
                                    <p>Pemilik Toko</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="tables">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="pemilik_toko">
                                                <span class="sub-item">Tambah Pemilik Toko</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="informasi_pemilik_toko">
                                                <span class="sub-item">Informasi Pemilik Toko</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#charts">
                                    <i class="fas fa-warehouse"></i>
                                    <p>Gudang</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="charts">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="barang">
                                                <span class="sub-item">Catat Barang</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="informasi_barang">
                                                <span class="sub-item">Informasi Barang</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Forms</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="#">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Karyawan</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Ubah Password Karyawan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="POST" autocomplete="off">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Ubah Password Karyawan</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                    <?php
                                                    echo $error;
                                                    ?>
                                                    <input type="hidden" value="<?= $data_karyawan['id_akses_login']; ?>" name="id_akses">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" class="form-control" placeholder="Password" aria-describedby="password-addon" name="passwordx" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus berisi setidaknya satu nomor dan satu huruf besar dan huruf kecil, dan setidaknya 8 atau lebih karakter">
                                                            <a class="input-group-text"><i class="far fa-eye-slash" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <div class="input-group" id="show_hide_password2">
                                                            <input type="password" class="form-control" placeholder="Confirm Password" aria-describedby="confirm-password-addon" name="copass" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus berisi setidaknya satu nomor dan satu huruf besar dan huruf kecil, dan setidaknya 8 atau lebih karakter">
                                                            <a class="input-group-text"><i class="far fa-eye-slash" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                            <a href="informasi_karyawan" class="btn btn-danger">Batal</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Bantuan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright ml-auto">
                        <i class="fa fa-heart heart text-danger"></i> <?php echo date("Y"); ?>, created by <a href="#">Kelompok 3</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


    <!-- Chart JS -->
    <script src="../../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Sweet Alert -->
    <script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Atlantis JS -->
    <script src="../../assets/js/atlantis.min.js"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="../../assets/js/setting-demo.js"></script>
    <script src="../../assets/js/demo.js"></script>
    <script>
        $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#177dff',
            fillColor: 'rgba(23, 125, 255, 0.14)'
        });

        $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#f3545d',
            fillColor: 'rgba(243, 84, 93, .14)'
        });

        $('#lineChart3').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("far fa-eye-slash");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("far fa-eye-slash");
                    $('#show_hide_password i').addClass("far fa-eye");
                }
            });
            $("#show_hide_password2 a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password2 input').attr("type") == "text") {
                    $('#show_hide_password2 input').attr('type', 'password');
                    $('#show_hide_password2 i').addClass("far fa-eye-slash");
                } else if ($('#show_hide_password2 input').attr("type") == "password") {
                    $('#show_hide_password2 input').attr('type', 'text');
                    $('#show_hide_password2 i').removeClass("far fa-eye-slash");
                    $('#show_hide_password2 i').addClass("far fa-eye");
                }
            });
        });
    </script>
</body>

</html>