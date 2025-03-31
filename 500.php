<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>500 Server Error - Posko PMI Kota Banjar</title>
    <link rel="icon" href="assets/img/posko.png" type="image/x-icon" />
    <meta name="description" content="Website resmi Posko PMI Kota Banjar untuk informasi dan layanan kesehatan, termasuk posko bencana dan layanan ambulans." />
    <meta name="keywords" content="PMI, Banjar, Kesehatan, Layanan, Darurat, Posko Bencana, Ambulans" />
    <meta name="author" content="Rudi Hermawan">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link type="text/css" href="css/volt.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('assets/img/background.svg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }
    </style>
</head>
<body>
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 order-2 order-lg-1 text-center text-lg-left">
                        <h1 class="mt-5">500<span class="text-primary"> – </span>Server Error</h1>
                        <p class="lead my-4">Maaf, terjadi kesalahan pada server kami. Silakan coba lagi nanti. Terima kasih atas pengertian Anda!</p>
                        <a href="index.php" class="btn d-inline-flex align-items-center justify-content-center mb-4" style="background-color: red; color: white;" id="reportButton">
                            <i class="fas fa-home me-2"></i>
                            Kembali ke halaman utama
                        </a>
                        <div id="ipInfo" class="mt-4"></div>
                    </div>
                    <div class="col-12 col-lg-7 order-1 order-lg-2 text-center d-flex align-items-center justify-content-center">
                        <img class="img-fluid w-75" src="assets/img/posko.png" alt="500 Server Error">
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="vendor/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/volt.js"></script>
    <script src="js/widget_disabilitas.js"></script>
    <script>
        function checkConnection() {
            fetch('koneksi.php')
                .then(response => {
                    if (response.ok) {
                        window.location.href = 'index.php';
                    } else {
                        setTimeout(() => {
                            location.reload();
                        }, 5000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    setTimeout(() => {
                        location.reload();
                    }, 5000);
                });
        }

        window.onload = checkConnection;
    </script>
</body>

</html>