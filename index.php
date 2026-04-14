<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Sekolah Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body{
            background-color:#f5f5f5;
        }
        .card{
            margin-top:80px;
        }
        .logo{
            width:90px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card text-center shadow-sm">
                <div class="card-body p-4">

                    <img src="asset/img/logo-smk.png" class="logo mb-3">

                    <h4>Perpustakaan</h4>
                    <p class="text-muted">SMK Karya Bhakti Brebes</p>

                    <div class="d-grid gap-2 mt-4">
                        <a href="login/login-anggota.php" class="btn btn-success">
                            <i class="bi bi-person"></i> Login Anggota
                        </a>

                        <a href="login/register-anggota.php" class="btn btn-outline-success">
                            <i class="bi bi-person-plus"></i> Daftar Anggota
                        </a>

                        <a href="login/login-admin.php" class="btn btn-primary">
                            <i class="bi bi-lock"></i> Login Admin
                        </a>
                    </div>

                </div>

                <div class="card-footer text-muted small">
                    © 2026 RPL | SMK Karya Bhakti Brebes
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>