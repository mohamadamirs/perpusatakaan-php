<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">
        <i class="bi bi-clock-history text-primary me-2"></i> Riwayat Peminjaman Saya
    </h5>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle border-0">
        <thead>
            <tr class="text-muted small text-uppercase">
                <th class="border-0 pb-3" width="5%">No</th>
                <th class="border-0 pb-3">Informasi Buku</th>
                <th class="border-0 pb-3 text-center">Tgl Pinjam</th>
                <th class="border-0 pb-3 text-center">Batas Kembali</th>
                <th class="border-0 pb-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            include '../koneksi.php';
            $id_anggota = $_SESSION['id_anggota'];
            $no = 1;
            $query = "SELECT * FROM transaksi 
                      JOIN buku ON transaksi.id_buku = buku.id_buku 
                      WHERE id_anggota = :id_anggota
                      ORDER BY id_trasnsaksi DESC";
            $data = $koneksi->prepare($query);
            $data->execute(['id_anggota' => $id_anggota]);
            $transaksi_list = $data->fetchAll();

            if(count($transaksi_list) > 0) {
                foreach ($transaksi_list as $t) {
                ?>
                <tr>
                    <td><span class="text-muted fw-medium"><?= $no++ ?></span></td>
                    <td>
                        <div class="fw-bold text-dark"><?= $t['judul_buku'] ?></div>
                        <div class="small text-muted"><?= $t['pengarang'] ?></div>
                    </td>
                    <td class="text-center">
                        <div class="small fw-medium text-dark"><?= date('d M Y', strtotime($t['tgl_pinjam'])) ?></div>
                    </td>
                    <td class="text-center">
                        <div class="small fw-medium text-dark"><?= date('d M Y', strtotime($t['tgl_kembali'])) ?></div>
                    </td>
                    <td class="text-center">
                        <?php if($t['status_transaksi'] == 'Peminjaman'): ?>
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill border-0">
                                <i class="bi bi-clock-history me-1"></i> Sedang Dipinjam
                            </span>
                        <?php else: ?>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill border-0">
                                <i class="bi bi-check-circle me-1"></i> Sudah Dikembalikan
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Anda belum pernah melakukan peminjaman
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
