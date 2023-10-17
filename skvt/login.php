<!DOCTYPE html>
<html lang="en" class="wf-flaticon-n4-inactive wf-simplelineicons-n4-active wf-fontawesome5solid-n4-active wf-lato-n4-active wf-lato-n3-active wf-lato-n7-active wf-fontawesome5regular-n4-active wf-lato-n9-active wf-fontawesome5brands-n4-active wf-active">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SKVT - Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="assets/img/icon.ico" type="image/x-icon" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/atlantis.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class=" card">
                    <div class="card-header">
                        <div class="card-title text-center">Sistem Informasi Keuangan Vano Textile</div>
                    </div>
                    <div class="card-body">
                        <?php
                        $error = '';
                        date_default_timezone_set("Asia/Jakarta");
                        include('cfg/config.php');
                        $lib = new config();
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            function input($data)
                            {
                                $data = trim($data);
                                $data = stripslashes($data);
                                $data = htmlspecialchars($data);
                                $data = strip_tags($data);
                                return $data;
                            }

                            //Akses
                            if (isset($_POST['action-login'])) {
                                // Secret Key ini kita ambil dari halaman Google reCaptcha
                                // Sesuai pada catatan saya di STEP 1 nomor 6
                                $secret_key = "6LfjLDsdAAAAAE8gaOJZlsxW1SPJHhjc39pnJ7kM";
                                // Disini kita akan melakukan komunkasi dengan google recpatcha
                                // dengan mengirimkan scret key dan hasil dari response recaptcha nya
                                $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response']);
                                $response = json_decode($verify);
                                if ($response->success) {
                                    $email = input($_POST['emailx']);
                                    $pass = input(md5($_POST['passwordx']));
                                    $query =  $lib->db->prepare("select * from akses_login where email=:email and pass=:password");
                                    $query->BindParam(":email", $email);
                                    $query->BindParam(":password", $pass);
                                    $query->execute();
                                    if ($query->rowCount() > 0) {
                                        session_start();
                                        $data = $query->fetch();
                                        if ($data['hak_akses'] === 'karyawan') {
                                            sleep(2);
                                            $_SESSION["id_akses"] = $data["id_akses"];
                                            echo "<script type='text/javascript'>alert('Selamat Datang Di Halaman Karyawan!');window.location.href = 'akses/karyawan/home';</script>";;
                                        } else {
                                            sleep(2);
                                            $_SESSION["id_akses"] = $data["id_akses"];
                                            echo "<script type='text/javascript'>alert('Selamat Datang Di Halaman Pemilik Toko!');window.location.href = 'akses/pemilik_toko/home';</script>";;
                                        }
                                    } else {
                                        $error = '<div class="mb-3">
                        <div class="alert alert-danger bg-danger text-white rounded" style="color:white" role="alert">
                          <strong>Login Gagal!</strong> Akun Tidak Dikenal.
                        </div>
                      </div>';
                                    }
                                } else {
                                    $error = '<div class="mb-3">
                        <div class="alert alert-danger bg-danger text-white rounded" style="color:white" role="alert">
                          <strong>Login Gagal!</strong> Captcha Tidak Valid!
                        </div>
                      </div>';
                                }
                            }
                        }
                        ?>

                        <form autocomplete="off" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <?=
                                    $error;
                                    ?>
                                    <div class="form-group">
                                        <label for="email2">Email</label>
                                        <input type="email" class="form-control" id="email2" name="emailx" placeholder="Enter Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="passwordx" id="password" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>reCaptcha <i class="fa fa-check xs text-success"></i></label>
                                        <div class="g-recaptcha" data-sitekey="6LfjLDsdAAAAAPZsvoLzSQg2jxZRnKCSxWNdGEjJ"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="action-login" class="btn btn-success" value="LOGIN">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Atlantis JS -->
    <script src="assets/js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo2.js"></script>
</body>

</html>