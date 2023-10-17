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
        echo "<script type='text/javascript'>alert('Anda Tidak Memiliki Akses Pemilik Toko!');window.location.href = '../../index';</script>";
        exit;
    };
} else {
    header('Location: ../../index');
}
if (isset($_GET["id"])) {
    $id_peng = $_GET["id"];
    $status_hapus = $lib->deletePengeluaran($id_peng);
    if ($status_hapus) {
        echo "<script type='text/javascript'>alert('Berhasil Mengapus Data!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SKVT - Informasi Pengeluaran</title>
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
                                    <img src="../../assets/img/gold.png" alt="..." class="avatar-img rounded-circle">
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
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a data-toggle="collapse" href="#base">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Pencatatan</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse show" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="informasi_pemasukan">
                                            <span class="sub-item text-success font-weight-bold mr-2">Pemasukan</span> <span class="fa fa-exchange-alt text-success"></span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a data-toggle="collapse" href="informasi_karyawan" aria-expanded="false">
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
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Informasi</h4>
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
                                <a href="#">Data</a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Pengeluaran</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Informasi Pengeluaran Vano Textile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <a class="btn btn-success" href="pengeluaran">Catat Pengeluaran</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="multi-filter-select" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Jenis Pengeluaran</th>
                                                    <th>Biaya Pengeluaran</th>
                                                    <th>Keterangan</th>
                                                    <th>Bukti Foto</th>
                                                    <th>Status</th>
                                                    <th>By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Jenis Pengeluaran</th>
                                                    <th>Biaya Pengeluaran</th>
                                                    <th>Keterangan</th>
                                                    <th>Bukti Foto</th>
                                                    <th>Status</th>
                                                    <th>By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $data_pengeluaran = $lib->showPengeluaran();
                                                foreach ($data_pengeluaran as $row) {
                                                ?>
                                                    <tr>
                                                        <td><?php if ($row['id_karyawan']) {
                                                                $data_kar = $lib->get_data_kar($row['id_karyawan']);
                                                                echo $data_kar['nama_karyawan'];
                                                            } else {
                                                                $data_pem = $lib->get_data_pem($row['id']);
                                                                echo $data_pem['nama_pemilik'];
                                                            } ?></td>
                                                        <td><?= $row['jenis_pengeluaran']; ?></td>
                                                        <td><?php $money = $lib->rupiah($row['biaya_pengeluaran']);
                                                            echo $money; ?>
                                                        </td>
                                                        <td><?= $row['ket']; ?></td>
                                                        <td><a href="../../assets/bukti/<?= $row['bukti_foto']; ?>" target="_blank"><?php echo "<img height='100' width='100' src=../../assets/bukti/" . $row['bukti_foto'] . ">"; ?></a></td>
                                                        <td><?php if ($row['status'] == 'process') {
                                                                echo "<span class='text-danger'>" . $row['status'] . "</span>";
                                                            } else {
                                                                echo "<span class='text-success'>" . $row['status'] . "</span>";
                                                            }  ?>
                                                        </td>
                                                        <td><?php if ($row['id']) {
                                                                $data_pem = $lib->get_data_pem($row['id']);
                                                                echo $data_pem['nama_pemilik'];
                                                            } else {
                                                                echo "Menunggu";
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <div class=" form-button-action">
                                                                <a href="ubah_data_pengeluaran?id=<?= $row['id_pengeluaran']; ?>" data-toggle="tooltip" class="btn btn-link btn-primary" data-original-title="Ubah">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="informasi_pengeluaran?id=<?= $row['id_pengeluaran']; ?>" data-toggle="tooltip" class="btn btn-link btn-danger" data-original-title="Hapus">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="10"><?php $hitung = $lib->hitungPerhari();
                                                                        $sum = $lib->rupiah($hitung);
                                                                        echo "Total Biaya Pengeluaran Hari Ini : <span class='text-danger'><b>" . $sum . "</b></span>"; ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <?php
                                        $tgl_awal = date("Y-m-d");
                                        $tgl_akhir = date('Y-m-d', strtotime('-7 days', strtotime($tgl_awal)));
                                        $data_total = $lib->penghitungMinggu($tgl_awal, $tgl_akhir);
                                        echo $data_total;
                                        ?>
                                    </div>
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
    <!--   Core JS Files   -->
    <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Atlantis JS -->
    <script src="../../assets/js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="../../assets/js/setting-demo2.js"></script>
    <script>
        $(document).ready(function() {
            $('#multi-filter-select').DataTable({
                "pageLength": 5,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $('<select class="form-control"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            });
        });
    </script>
</body>

</html>