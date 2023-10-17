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
$hitung = $lib->hitungPerhari();
$sum = $lib->rupiah($hitung);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SKVT - Dashboard</title>
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
                                        <!-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <a class="dropdown-item" href="#">My Balance</a>
                                        <a class="dropdown-item" href="#">Inbox</a> -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit Profile</a>
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
                            <li class="nav-item active">
                                <a data-toggle="collapse" href="home" aria-expanded="false">
                                    <i class="fas fa-home"></i>
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
                                            <a href="informasi_pemasukan">
                                                <span class="sub-item text-success font-weight-bold mr-2">Pemasukan</span> <span class="fa fa-exchange-alt text-success"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="informasi_pengeluaran">
                                                <span class="sub-item text-danger font-weight-bold mr-2">Pengeluaran</span> <span class="fa fa-exchange-alt text-danger"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#sidebarLayouts">
                                    <i class="fas fa-users"></i>
                                    <p>Karyawan</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="sidebarLayouts">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="karyawan">
                                                <span class="sub-item">Tambah Karyawan</span>
                                            </a>
                                        </li>
                                        <li>
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
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-5">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div>
                                    <h2 class="text-white pb-2 fw-bold">Dashboard Sistem Keuangan Vano Textile <img class="mr-2 d-none d-sm-inline" src="../../assets/img/gold.png" height="63" width="55"></h2>
                                    <h5 class="text-white op-7 mb-2">Selamat Datang, <?= $get_profile['nama_pemilik']; ?> </h5>
                                </div>
                                <div class="ml-md-auto py-2 py-md-0">
                                    <a href="#" class="btn btn-white btn-border btn-round mr-2">Kelola Laporan</a>
                                    <a href="#" class="btn btn-secondary btn-round">Laporan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-down-arrow-2 text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Pemasukan Hari Ini</p>
                                                    <h4 class="card-title"><?php echo $sum; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-arrows text-danger"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Pengeluaran Hari Ini</p>
                                                    <h4 class="card-title"><?php echo $sum; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-handshake text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Transaksi Hari Ini</p>
                                                    <h4 class="card-title"><?php echo $sum; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-coins text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Laba Bersih Hari Ini</p>
                                                    <h4 class="card-title"><?php echo $sum; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">User Statistics</div>
                                            <div class="card-tools">
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                                    <span class="btn-label">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                    Export
                                                </a>
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                                    <span class="btn-label">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                    Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="min-height: 375px">
                                            <canvas id="statisticsChart"></canvas>
                                        </div>
                                        <div id="myChartLegend"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan Minggu Ini</div>
                                        <div class="card-category"><?php $date = date('d F');
                                                                    echo date('d F', (strtotime('-7 day', strtotime($date))));  ?> - <?php echo date("d F"); ?></div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="mb-4 mt-2">
                                            <h1>$4,578.58</h1>
                                        </div>
                                        <div class="pull-in">
                                            <canvas id="dailySalesChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-info bg-info-gradient">
                                    <div class="card-body">
                                        <h4 class="mb-2 fw-bold">Alamat Kami</h4>
                                        <center>
                                            <iframe class="mt-2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9766.26409280179!2d107.55578972471871!3d-6.936846338068038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ef2047aabc9d%3A0xc7b12ee155b0f99!2sVano%20textile!5e0!3m2!1sid!2sid!4v1637165054366!5m2!1sid!2sid" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="h1 fw-bold float-right text-primary">+5%</div>
                                        <h2 class="mb-2">17</h2>
                                        <p class="text-muted">Users online</p>
                                        <div class="pull-in sparkline-fix">
                                            <div id="lineChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="h1 fw-bold float-right text-danger">-3%</div>
                                        <h2 class="mb-2">27</h2>
                                        <p class="text-muted">New Users</p>
                                        <div class="pull-in sparkline-fix">
                                            <div id="lineChart2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="h1 fw-bold float-right text-warning">+7%</div>
                                        <h2 class="mb-2">213</h2>
                                        <p class="text-muted">Transactions</p>
                                        <div class="pull-in sparkline-fix">
                                            <div id="lineChart3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"><i class="fa fa-fire mr-1"></i> Top Produk Vano Textile</div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="d-flex">
                                            <div class="avatar">
                                                <img src="../../assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                                            </div>
                                            <div class="flex-1 pt-1 ml-2">
                                                <h6 class="fw-bold mb-1">CSS</h6>
                                                <small class="text-muted">Cascading Style Sheets</small>
                                            </div>
                                            <div class="d-flex ml-auto align-items-center">
                                                <h3 class="text-info fw-bold">+$17</h3>
                                            </div>
                                        </div>
                                        <div class="separator-dashed"></div>
                                        <div class="d-flex">
                                            <div class="avatar">
                                                <img src="../../assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                                            </div>
                                            <div class="flex-1 pt-1 ml-2">
                                                <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                                                <small class="text-muted">The Best Donuts</small>
                                            </div>
                                            <div class="d-flex ml-auto align-items-center">
                                                <h3 class="text-info fw-bold">+$300</h3>
                                            </div>
                                        </div>
                                        <div class="separator-dashed"></div>
                                        <div class="d-flex">
                                            <div class="avatar">
                                                <img src="../../assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                                            </div>
                                            <div class="flex-1 pt-1 ml-2">
                                                <h6 class="fw-bold mb-1">Ready Pro</h6>
                                                <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                                            </div>
                                            <div class="d-flex ml-auto align-items-center">
                                                <h3 class="text-info fw-bold">+$350</h3>
                                            </div>
                                        </div>
                                        <div class="separator-dashed"></div>
                                        <div class="pull-in">
                                            <canvas id="topProductsChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title fw-mediumbold"><i class="fa fa-users mr-1"></i> Karyawan Vano Textile</div>
                                        <div class="card-list">
                                            <div class="item-list">
                                                <div class="avatar">
                                                    <img src="../../assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle">
                                                </div>
                                                <div class="info-user ml-3">
                                                    <div class="username">John Doe</div>
                                                    <div class="status">Back End Developer</div>
                                                </div>
                                                <i class="fa fa-circle text-danger align-right"></i>
                                            </div>
                                            <div class="item-list">
                                                <div class="avatar">
                                                    <img src="../../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                                </div>
                                                <div class="info-user ml-3">
                                                    <div class="username">Talha</div>
                                                    <div class="status">Front End Designer</div>
                                                </div>
                                                <i class="fa fa-circle text-success align-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"><i class="fa fa-clipboard-list mr-1"></i> Aktivitas Kamu</div>
                                    </div>
                                    <div class="card-body">
                                        <ol class="activity-feed">
                                            <li class="feed-item feed-item-secondary">
                                                <time class="date" datetime="9-25">Sep 25</time>
                                                <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                                            </li>
                                            <li class="feed-item feed-item-success">
                                                <time class="date" datetime="9-24">Sep 24</time>
                                                <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                                            </li>
                                            <li class="feed-item feed-item-info">
                                                <time class="date" datetime="9-23">Sep 23</time>
                                                <span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
                                            </li>
                                            <li class="feed-item feed-item-warning">
                                                <time class="date" datetime="9-21">Sep 21</time>
                                                <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                                            </li>
                                            <li class="feed-item feed-item-danger">
                                                <time class="date" datetime="9-18">Sep 18</time>
                                                <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                                            </li>
                                            <li class="feed-item">
                                                <time class="date" datetime="9-17">Sep 17</time>
                                                <span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
                                            </li>
                                        </ol>
                                    </div>
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

    <!-- Bootstrap Notify -->
    <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

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
</body>

</html>