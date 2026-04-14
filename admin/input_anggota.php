<h5 class="fw-bold mb-4">
    <i class="bi bi-person-plus"></i> Tambah Data Anggota
</h5>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">

                <form method="post">

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

                    <div class="d-flex justify-content-between">
                        <a href="?halaman=data_anggota" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        <button type="submit" name="simpan" class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php  
if (isset($_POST['simpan'])) {
    include '../koneksi.php';

    $nis = $_POST['nis'];
    $nama = $_POST['nama_anggota'];
    $user = $_POST['username_anggota'];
    $pass = $_POST['password_anggota'];
    $kelas = $_POST['kelas'];

    try {
        $query = "INSERT INTO anggota (nis, nama_anggota, username, password, kelas) VALUES (:nis, :nama, :user, :pass, :kelas)";
        $simpan = $koneksi->prepare($query);
        $simpan->execute([
            'nis' => $nis,
            'nama' => $nama,
            'user' => $user,
            'pass' => $pass,
            'kelas' => $kelas
        ]);

        echo "<script>
            alert('Data Anggota Berhasil Disimpan');
            window.location.assign('?halaman=data_anggota');
        </script>";
    } catch (PDOException $e) {
        echo "<script>
            alert('Data Anggota Gagal Disimpan');
            window.location.assign('?halaman=input_anggota');
        </script>";
    }
}
?>
