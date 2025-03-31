<?php
session_start();
session_regenerate_id(true);

require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Posko PMI Kota Banjar</title>
    <link rel="icon" href="../assets/img/posko.png" type="image/x-icon">
    <meta name="description" content="Website resmi Posko PMI Kota Banjar untuk informasi dan layanan kesehatan, termasuk posko bencana dan layanan ambulans.">
    <meta name="keywords" content="PMI, Banjar, Kesehatan, Layanan, Darurat, Posko Bencana, Ambulans">
    <meta name="author" content="Rudi Hermawan">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="css/volt.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .bg-soft {
            background: url('assets/img/background.svg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: block;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
    </style>
</head>

<body class="bg-soft">
    <main>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <img src="assets/img/posko.png" alt="Logo" class="mb-1" style="max-width: 150px; height: auto;">
                                <!-- <h5 style="color: rgb(8, 52, 97);">Posko PMI Kota Banjar</h5> -->
                            </div>
                            <?php
                            if (isset($_GET['alert'])) {
                                $alertMessages = [
                                    'logout' => '<div class="alert alert-success" role="alert"><strong>Berhasil!</strong> Anda telah berhasil logout.</div>',
                                    'gagal' => '<div class="alert alert-danger" role="alert"><strong>Galat!</strong> Username atau Password salah.</div>',
                                    'not_found' => '<div class="alert alert-warning" role="alert"><strong>Peringatan!</strong> Data tidak ditemukan pada server.</div>',
                                    'belum_login' => '<div class="alert alert-info" role="alert"><strong>Informasi!</strong> Anda harus login untuk mengakses halaman ini.</div>',
                                    'invalid_request' => '<div class="alert alert-danger" role="alert"><strong>Galat!</strong> Permintaan tidak valid.</div>',
                                ];
                                $alertType = $_GET['alert'];
                                echo isset($alertMessages[$alertType]) ? $alertMessages[$alertType] : '<div class="alert alert-secondary" role="alert"><strong>Informasi!</strong> Tidak ada pesan yang tersedia.</div>';
                            }
                            ?>

                            <form action="auth.php" method="post" class="mt-4">
                                <div class="form-group mb-4">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Username" name="username" required autocomplete="username" autofocus>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" placeholder="Masukkan Password" class="form-control" name="password" required autocomplete="current-password">
                                </div>
                                <div class="form-check mb-4">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                    <label for="remember" class="form-check-label">Ingat Saya</label>
                                </div>
                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-sign-in-alt"></i> Masuk
                                    </button>
                                    <a href="monitoring.php" class="btn btn-info mt-2">
                                        <i class="fas fa-home"></i> Monitoring
                                    </a>
                                </div>
                            </form>
                            <br>
                            <div class="text-center">
                                <small>Made with ❤️ for PMI Kota Banjar<br><strong>Build Version</strong> 1.0</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Core JS -->
    <script src="vendor/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="assets/js/volt.js"></script>
    <script src="js/widget_disabilitas.js"></script>
</body>

</html>