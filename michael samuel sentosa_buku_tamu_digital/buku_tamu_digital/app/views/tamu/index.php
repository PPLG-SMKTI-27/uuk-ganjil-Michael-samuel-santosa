<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container">
    <div class="header-actions">
        <h1>Data Tamu</h1>
        <a href="index.php?controller=tamu&action=create" class="btn btn-primary">Tambah Tamu</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Data berhasil disimpan!</div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">Terjadi kesalahan!</div>
    <?php endif; ?>

    <!-- Form Pencarian -->
    <div class="search-container">
        <form method="GET" action="">
            <input type="hidden" name="controller" value="tamu">
            <input type="hidden" name="action" value="index">
            <div class="search-group">
                <input type="text" name="search" placeholder="Cari nama, instansi, atau keperluan..." 
                       value="<?php echo htmlspecialchars($data['keyword']); ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if (!empty($data['keyword'])): ?>
                    <a href="index.php?controller=tamu&action=index" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="table-container">
        <?php if (empty($data['tamu'])): ?>
            <p class="no-data">Tidak ada data tamu</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Keperluan</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Tanggal Bertemu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['tamu'] as $index => $tamu): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($tamu['nama']); ?></td>
                        <td><?php echo htmlspecialchars($tamu['instansi']); ?></td>
                        <td><?php echo htmlspecialchars($tamu['keperluan']); ?></td>
                        <td><?php echo htmlspecialchars($tamu['no_telepon']); ?></td>
                        <td><?php echo htmlspecialchars($tamu['email']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($tamu['tanggal_bertemu'])); ?></td>
                        <td class="actions">
                            <a href="index.php?controller=tamu&action=edit&id=<?php echo $tamu['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="index.php?controller=tamu&action=delete&id=<?php echo $tamu['id']; ?>" 
                               class="btn btn-delete"
                               onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>