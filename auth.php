<?php
// Menghubungkan dengan koneksi
include 'koneksi.php'; // Pastikan ini mengarah ke file koneksi yang benar

// Memulai session
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['id'])) {
    // Jika sudah login, redirect ke halaman yang sesuai
    switch ($_SESSION['role']) {
        case "Personel":
            header("location:public/");
            exit();
        case "Admin":
            header("location:admin/");
            exit();
        default:
            header("location:index.php?alert=gagal");
            exit();
    }
}

// Pastikan form di-submit dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data yang dikirim dari form
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; // Get the plaintext password
    $rememberMe = isset($_POST['remember_me']); // Menangkap checkbox remember me

    // Query untuk mendapatkan data pengguna
    $login = mysqli_query($koneksi, "SELECT * FROM users WHERE users_username='$username'");
    if (!$login) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($login);

    if ($data) {
        // Verifikasi password menggunakan password_verify
        if (password_verify($password, $data['users_password'])) {
            $_SESSION['id'] = $data['users_id'];
            $_SESSION['nama'] = $data['users_nama'];
            $_SESSION['username'] = $data['users_username'];
            $_SESSION['foto'] = $data['users_foto'];
            $_SESSION['email'] = $data['users_email'];
            $_SESSION['role'] = $data['users_role'];

            // Jika pengguna memilih "Remember Me"
            if ($rememberMe) {
                // Set cookie untuk 30 hari
                setcookie('username', $username, time() + (30 * 24 * 60 * 60), "/");
                // Store a secure token instead of the password
                $token = bin2hex(random_bytes(16)); // Generate a random token
                setcookie('auth_token', $token, time() + (30 * 24 * 60 * 60), "/");
                // Store the token in the database associated with the user
                mysqli_query($koneksi, "UPDATE users SET cookie_token='$token' WHERE users_id='{$data['users_id']}'");
            }

            // Redirect berdasarkan role pengguna
            switch ($data['users_role']) {
                case "Personel":
                    header("location:public/");
                    exit();
                case "Admin":
                    header("location:admin/");
                    exit();
                default:
                    header("location:index.php?alert=gagal");
                    exit();
            }
        } else {
            // Password salah
            header("location:index.php?alert=gagal");
            exit();
        }
    } else {
        // Username tidak ditemukan
        header("location:index.php?alert=not_found");
        exit();
    }
} else {
    // Jika pengguna belum login, redirect dengan alert
    header("location:index.php?alert=belum_login");
    exit();
}
?>