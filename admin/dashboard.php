<?php
session_start();
if (empty($_SESSION['id_admin'])) {
    header("location:../login/login-admin.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
body{
    background:#f5f7fb;
}

/* Navbar abu-abu */
.navbar{
    background:#495057;
}

.btn-logout{
    background:white;
    color:#495057;
}

.btn-logout:hover{
    background:#e9ecef;
}

/* Badge welcome */
.welcome-badge{
background:#e7f3ff;
color:#495057;
padding:6px 14px;
border-radius:20px;
font-size:13px;
font-weight:bold;
display:inline-block;
}

/* card menu */
.menu-card{
transition:0.2s;
}

.menu-card:hover{
transform:translateY(-3px);
}
</style>

</head>
<body>

<?php
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
<div class="container">

<a class="navbar-brand" href="dashboard.php">
<i class="bi bi-book"></i> Admin Perpustakaan
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link" href="dashboard.php">
<i class="bi bi-house"></i> Dashboard
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="?halaman=input_anggota">
<i class="bi bi-person-plus"></i> Tambah Anggota
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="?halaman=data_anggota">
<i class="bi bi-people"></i> Data Anggota
</a>
</li>

</ul>

<span class="navbar-text text-white me-3">
<i class="bi bi-person"></i> <?= $_SESSION['nama_admin']; ?>
</span>

<a href="../login/logout.php" class="btn btn-logout btn-sm">
<i class="bi bi-box-arrow-right"></i> Logout
</a>

</div>
</div>
</nav>

<!-- Konten -->
<div class="container mt-4">

<div class="card shadow-sm">
<div class="card-body">

<?php
if(empty($halaman)){
?>

<!-- Dashboard Welcome -->

<div class="welcome-badge mb-3">
SELAMAT DATANG
</div>

<h3 class="fw-bold mb-2">
Halo, <?= $_SESSION['nama_admin']; ?>!
</h3>

<p class="text-muted mb-4">
Selamat datang di Panel Admin Perpustakaan SMK Karya Bhakti Brebes.
Silahkan kelola data anggota dan data buku.
</p>

<div class="row">

<div class="col-md-6 mb-3">
<a href="?halaman=input_anggota" class="text-decoration-none">

<div class="card shadow-sm h-100 menu-card">
<div class="card-body text-center">

<i class="bi bi-person-plus text-success fs-1"></i>

<h5 class="mt-3">Tambah Anggota</h5>

<p class="text-muted small">
Tambahkan anggota baru ke dalam sistem perpustakaan.
</p>

</div>
</div>

</a>
</div>

<div class="col-md-6 mb-3">
<a href="?halaman=data_anggota" class="text-decoration-none">

<div class="card shadow-sm h-100 menu-card">
<div class="card-body text-center">

<i class="bi bi-people text-primary fs-1"></i>

<h5 class="mt-3">Data Anggota</h5>

<p class="text-muted small">
Lihat dan kelola data anggota yang sudah terdaftar.
</p>

</div>
</div>

</a>
</div>

</div>

<?php
}else{

if (file_exists($halaman.".php")) {
    include $halaman.".php";
} else {
    echo "Halaman tidak ditemukan";
}

}
?>

</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
