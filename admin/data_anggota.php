<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">
        <i class="bi bi-people text-primary me-2"></i> Data Anggota
    </h5>
    <a href="?halaman=input_anggota" class="btn btn-success btn-sm">
        <i class="bi bi-plus-circle"></i> Tambah Anggota
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle border-0">
        <thead>
            <tr class="text-muted small text-uppercase">
                <th class="border-0 pb-3" width="5%">No</th>
                <th class="border-0 pb-3">NIS</th>
                <th class="border-0 pb-3">Nama Anggota</th>
                <th class="border-0 pb-3">Kelas</th>
                <th class="border-0 pb-3 text-center">Username</th>
                <th class="border-0 pb-3 text-center" width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            include '../koneksi.php';
            $no = 1;
            $query = "SELECT * FROM anggota ORDER BY nama_anggota ASC";
            $data = $koneksi->query($query);
            $anggota_list = $data->fetchAll();

            if(count($anggota_list) > 0) {
                foreach ($anggota_list as $anggota) {
                ?>
                <tr>
                    <td><span class="text-muted fw-medium"><?= $no++ ?></span></td>
                    <td>
                        <div class="fw-bold text-dark"><?= $anggota['nis'] ?></div>
                    </td>
                    <td>
                        <div class="fw-bold text-dark"><?= $anggota['nama_anggota'] ?></div>
                    </td>
                    <td>
                        <div class="small text-muted"><?= $anggota['kelas'] ?></div>
                    </td>
                    <td class="text-center">
                        <div class="small fw-medium text-dark"><?= $anggota['username'] ?></div>
                    </td>
                    <td class="text-center">
                        <a href="?halaman=edit_anggota&id=<?= $anggota['id_anggota']; ?>" class="btn btn-warning btn-sm rounded-3 px-2 fw-bold">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="?halaman=hapus_anggota&id=<?= $anggota['id_anggota']; ?>" class="btn btn-danger btn-sm rounded-3 px-2 fw-bold" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Belum ada data anggota
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
