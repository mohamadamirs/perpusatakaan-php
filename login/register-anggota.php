<?php
session_start();

if (!empty($_SESSION['id_anggota'])) {
    header("location:../anggota/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Anggota - Perpustakaan</title>

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
            max-width: 450px;
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

        .btn-register {
            background: #198754;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: #157347;
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

        .error-msg,
        .success-msg {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .error-msg {
            color: #dc3545;
        }

        .success-msg {
            color: #198754;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="card">
        <div class="card-header">
            <div>
                <i class="bi bi-person-plus"></i>
                <h4 class="mb-0">Daftar Anggota</h4>
            </div>
        </div>
        <div class="card-body p-4">
            <form method="POST">
                <?php
                if (isset($_POST['register'])) {
                    include '../koneksi.php';

                    $nis = trim($_POST['nis']);
                    $nama = trim($_POST['nama_anggota']);
                    $user = trim($_POST['username_anggota']);
                    $pass = trim($_POST['password_anggota']);
                    $kelas = trim($_POST['kelas']);

                    $check = $koneksi->prepare("SELECT * FROM anggota WHERE username = :username");
                    $check->execute(['username' => $user]);

                    if ($check->rowCount() > 0) {
                        echo '<div class="error-msg"><i class="bi bi-exclamation-circle"></i> Username sudah digunakan.</div>';
                    } else {
                        try {
                            $query = "INSERT INTO anggota (nis, nama_anggota, username, password, kelas) VALUES (:nis, :nama, :user, :pass, :kelas)";
                            $stmt = $koneksi->prepare($query);
                            $stmt->execute([
                                'nis' => $nis,
                                'nama' => $nama,
                                'user' => $user,
                                'pass' => $pass,
                                'kelas' => $kelas
                            ]);

                            echo '<div class="success-msg"><i class="bi bi-check-circle"></i> Pendaftaran berhasil. Silakan login.</div>';
                        } catch (PDOException $e) {
                            echo '<div class="error-msg"><i class="bi bi-exclamation-circle"></i> Terjadi kesalahan saat mendaftar.</div>';
                        }
                    }
                }
                ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIS</label>
                    <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Anggota</label>
                    <input type="text" name="nama_anggota" class="form-control" placeholder="Nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Username</label>
                    <input type="text" name="username_anggota" class="form-control" placeholder="Username untuk login" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password_anggota" class="form-control" placeholder="Password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: X RPL 1" required>
                </div>

                <button type="submit" name="register" class="btn btn-register w-100">
                    <i class="bi bi-send-check"></i> Daftar
                </button>
            </form>

            <div class="footer-link">
                <a href="login-anggota.php">
                    <i class="bi bi-arrow-left"></i> Sudah punya akun? Login
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
