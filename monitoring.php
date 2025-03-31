<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posko PMI Kota Banjar</title>
    <meta name="description" content="Website resmi Posko PMI Kota Banjar, menyediakan informasi lengkap tentang layanan kesehatan, penanganan bencana, layanan ambulans, dan program kemanusiaan lainnya untuk mendukung masyarakat." />
    <meta name="keywords" content="PMI, Banjar, Kesehatan, Layanan Kemanusiaan, Penanganan Bencana, Layanan Ambulans, Donor Darah, Pelatihan Pertolongan Pertama, Kesehatan Masyarakat" />
    <meta name="author" content="Rudi Hermawan">
    <meta name="robots" content="index, follow">

    <link rel="icon" type="image/png" href="assets/img/posko.png">
    <link rel="stylesheet" href="css/volt.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('assets/img/background.svg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 5px;
        }

        .card {
            margin: 20px 0;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
            height: auto;
            min-height: 100px;
        }

        #myChart {
            width: 100%;
            height: 400px;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .card {
                min-height: 200px;
            }
        }

        @media (min-width: 769px) {
            .card {
                min-height: 400px;
            }
        }
    </style>

    <script>
        setTimeout(function() {
            location.reload();
        }, 60000);
    </script>
</head>

<body>
    <main>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container text-center">
                <div class="col-12 mb-2">
                    <a href="index.php">
                        <img src="assets/img/posko.png" class="mb-2" width="100px" alt="Logo" class="logo">
                    </a>
                    <h5><strong>POSKO PMI KOTA BANJAR</strong></h5>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 10px;">
                    <small>Made with ❤️ for PMI Kota Banjar<br> Build Version 1.0</small>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/js/volt.js"></script>
    <script src="js/widget_disabilitas.js"></script>
    <script>
        <?php
        include 'koneksi.php';

        // Fetch disaster situation reports
        $guru = $koneksi->query("SELECT jenis_kejadian, COUNT(*) as jumlah FROM laporan_situasi GROUP BY jenis_kejadian");
        $dataLabelBencana = [];
        $jmlDataBencana = [];

        if ($guru->num_rows > 0) {
            while ($data = $guru->fetch_assoc()) {
                $dataLabelBencana[] = $data['jenis_kejadian'];
                $jmlDataBencana[] = $data['jumlah'];
            }
        } else {
            $dataLabelBencana = ['Tidak ada data'];
            $jmlDataBencana = [0];
        }

        // Fetch ambulance service reports
        $layananQuery = $koneksi->query("SELECT jenis_layanan, COUNT(*) as jumlah FROM ambulance_layanan GROUP BY jenis_layanan");
        $dataLabelAmbulance = [];
        $jmlDataAmbulance = [];

        if ($layananQuery->num_rows > 0) {
            while ($data = $layananQuery->fetch_assoc()) {
                $dataLabelAmbulance[] = $data['jenis_layanan'];
                $jmlDataAmbulance[] = $data['jumlah'];
            }
        } else {
            $dataLabelAmbulance = ['Tidak ada data'];
            $jmlDataAmbulance = [0];
        }

        // Combine labels and data
        $combinedLabels = array_merge($dataLabelBencana, $dataLabelAmbulance);
        $combinedData = array_merge($jmlDataBencana, $jmlDataAmbulance);
        ?>

        // Function to create the chart
        const createChart = (ctx, labels, data) => {
            const backgroundColors = labels.map(() => {
                const hue = Math.floor(Math.random() * 360);
                return `hsl(${hue}, 70%, 50%)`;
            });

            const chartData = {
                labels: labels,
                datasets: [{
                    label: 'Statistik Laporan Situasi Bencana dan Layanan Ambulance',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: 'rgb(23, 125, 255)',
                    borderWidth: 1,
                    hoverOffset: 5
                }],
            };

            const config = {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: false
                            }
                        },
                        x: {
                            title: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Statistik Laporan Situasi Bencana dan Layanan Ambulance'
                        }
                    }
                }
            };

            return new Chart(ctx, config);
        };

        const ctxCombined = document.getElementById('myChart').getContext('2d');
        createChart(ctxCombined, <?php echo json_encode($combinedLabels); ?>, <?php echo json_encode($combinedData); ?>);
    </script>
</body>

</html>