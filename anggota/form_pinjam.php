<?php  
include '../koneksi.php';
$id_buku = $_GET['id_buku'];
$query = $koneksi->prepare("SELECT * FROM buku WHERE id_buku = :id_buku");
$query->execute(['id_buku' => $id_buku]);
$b = $query->fetch();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">
        <i class="bi bi-calendar-check text-primary me-2"></i> Konfirmasi Peminjaman
    </h5>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-book-half text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1"><?= $b['judul_buku'] ?></h4>
                    <p class="text-muted small mb-0">Oleh <?= $b['pengarang'] ?></p>
                </div>

                <form action="?halaman=pinjam_buku" method="POST">
                    <input type="hidden" name="id_buku" value="<?= $id_buku ?>">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small text-uppercase">Tanggal Pengembalian</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-calendar-event text-primary"></i>
                            </span>
                            <input type="date" name="tgl_kembali" class="form-control border-start-0 ps-0" value="<?= date('Y-m-d', strtotime('+7 days')) ?>" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                        </div>
                        <small class="text-muted mt-2 d-block">
                            Pilih tanggal kapan Anda berencana mengembalikan buku ini.
                        </small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="konfirmasi" class="btn btn-primary py-3 rounded-3 fw-bold shadow-sm">
                            <i class="bi bi-check-circle-fill me-2"></i> Konfirmasi Pinjam
                        </button>

                        <a href="?halaman=data_buku" class="btn btn-link text-muted text-decoration-none small">
                            Batalkan
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
