<?php  
include '../koneksi.php';

if (isset($_POST['id_buku']) || isset($_GET['id_buku'])) {
    $id_buku = isset($_POST['id_buku']) ? $_POST['id_buku'] : $_GET['id_buku'];
    $id_anggota = $_SESSION['id_anggota'];
    $tgl_pinjam = date('Y-m-d');
    
    if (isset($_POST['tgl_kembali'])) {
        $tgl_kembali = $_POST['tgl_kembali'];
    } else {
        $tgl_kembali = date('Y-m-d', strtotime('+7 days'));
    }

    try {
        $cek_buku = $koneksi->prepare("SELECT status FROM buku WHERE id_buku = :id_buku");
        $cek_buku->execute(['id_buku' => $id_buku]);
        $b = $cek_buku->fetch();

        if ($b['status'] == 'Tersedia') {
            $query = "INSERT INTO transaksi (id_anggota, id_buku, tgl_pinjam, tgl_kembali, status_transaksi) 
                      VALUES (:id_anggota, :id_buku, :tgl_pinjam, :tgl_kembali, 'Peminjaman')";
            $simpan = $koneksi->prepare($query);
            $simpan->execute([
                'id_anggota' => $id_anggota,
                'id_buku' => $id_buku,
                'tgl_pinjam' => $tgl_pinjam,
                'tgl_kembali' => $tgl_kembali
            ]);

            $update = $koneksi->prepare("UPDATE buku SET status = 'Tidak' WHERE id_buku = :id_buku");
            $update->execute(['id_buku' => $id_buku]);

            echo "<script>
                alert('Berhasil meminjam buku! Silahkan ambil buku di perpustakaan.');
                window.location.assign('?halaman=history_peminjaman');
            </script>";
        } else {
            echo "<script>
                alert('Maaf, buku ini baru saja dipinjam oleh orang lain.');
                window.location.assign('?halaman=data_buku');
            </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
            alert('Gagal melakukan peminjaman. Silahkan coba lagi.');
            window.location.assign('?halaman=data_buku');
        </script>";
    }
} else {
    header("location:?halaman=data_buku");
}
?>
