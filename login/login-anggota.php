<?php
session_start();

// Jika sudah login, redirect ke dashboard
if (!empty($_SESSION['id_anggota'])) {
    header("location:../anggota/dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Anggota - Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #0956ca 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 0 15px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: #0d6efd;
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 30px 0;
            text-align: center;
        }

        .card-header i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-login {
            background: #0d6efd;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #0956ca;
        }

        .footer-link {
            text-align: center;
            margin-top: 15px;
        }

        .footer-link a {
            color: #0d6efd;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        .error-msg {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="card">
        <div class="card-header">
            <div>
                <i class="bi bi-person-circle"></i>
                <h4 class="mb-0">Login Anggota</h4>
            </div>
        </div>
        <div class="card-body p-4">
            <form method="POST">
                <?php
                if (isset($_POST['login'])) {
                    include '../koneksi.php';

                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $query = "SELECT * FROM anggota WHERE username = :username AND password = :password";
                    $result = $koneksi->prepare($query);
                    $result->execute(['username' => $username, 'password' => $password]);
                    $row = $result->fetch();

                    if ($result->rowCount() > 0) {
                        $_SESSION['id_anggota'] = $row['id_anggota'];
                        $_SESSION['nama_anggota'] = $row['nama_anggota'];
                        header("location:../anggota/dashboard.php");
                    } else {
                        echo '<div class="error-msg"><i class="bi bi-exclamation-circle"></i> Username atau password salah!</div>';
                    }
                }
                ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-person text-muted"></i>
                        </span>
                        <input type="text" name="username" class="form-control border-start-0 ps-0" placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-lock text-muted"></i>
                        </span>
                        <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" name="login" class="btn btn-login btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </button>
            </form>

            <div class="footer-link mb-2 text-center">
                Belum punya akun? <a href="register-anggota.php">Daftar Sekarang</a>
            </div>

            <div class="footer-link">
                <a href="../index.php">
                    <i class="bi bi-arrow-left"></i> Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
