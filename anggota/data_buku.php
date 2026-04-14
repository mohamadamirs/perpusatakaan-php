<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">
        <i class="bi bi-book text-primary me-2"></i> Koleksi Buku
    </h5>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle border-0">
        <thead>
            <tr class="text-muted small text-uppercase">
                <th class="border-0 pb-3" width="5%">No</th>
                <th class="border-0 pb-3">Informasi Buku</th>
                <th class="border-0 pb-3">Penerbit & Tahun</th>
                <th class="border-0 pb-3 text-center">Status</th>
                <th class="border-0 pb-3 text-center" width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            include '../koneksi.php';
            $no = 1;
            $query = "SELECT * FROM buku ORDER BY judul_buku ASC";
            $data = $koneksi->query($query);
            $buku_list = $data->fetchAll();

            foreach ($buku_list as $buku) {
            ?>
            <tr>
                <td><span class="text-muted fw-medium"><?= $no++ ?></span></td>
                <td>
                    <div class="fw-bold text-dark"><?= $buku['judul_buku'] ?></div>
                    <div class="small text-muted"><?= $buku['pengarang'] ?></div>
                </td>
                <td>
                    <div class="small fw-medium text-dark"><?= $buku['penerbit'] ?></div>
                    <div class="small text-muted"><?= $buku['tahun_terbit'] ?></div>
                </td>
                <td class="text-center">
                    <?php if($buku['status'] == 'Tersedia'): ?>
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill border-0">
                            <i class="bi bi-check-circle-fill me-1"></i> Tersedia
                        </span>
                    <?php else: ?>
                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill border-0">
                            <i class="bi bi-x-circle-fill me-1"></i> Dipinjam
                        </span>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?php if($buku['status'] == 'Tersedia'): ?>
                        <a href="?halaman=form_pinjam&id_buku=<?= $buku['id_buku']; ?>" class="btn btn-primary btn-sm rounded-3 px-3 fw-bold">
                            <i class="bi bi-plus-circle"></i> Pinjam
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary btn-sm rounded-3 px-3 fw-bold" disabled>
                            <i class="bi bi-check-circle"></i> Tersedia Nanti
                        </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
