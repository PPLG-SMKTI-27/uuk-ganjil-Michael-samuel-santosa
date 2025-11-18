<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container">
    <h1>Tambah Data Tamu</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" class="form">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required 
                   value="<?php echo $_POST['nama'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label for="instansi">Instansi:</label>
            <input type="text" id="instansi" name="instansi" required
                   value="<?php echo $_POST['instansi'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan:</label>
            <textarea id="keperluan" name="keperluan" required><?php echo $_POST['keperluan'] ?? ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="tanggal_bertemu">Tanggal Bertemu:</label>
            <input type="date" id="tanggal_bertemu" name="tanggal_bertemu" required
                   value="<?php echo $_POST['tanggal_bertemu'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label for="no_telepon">No. Telepon:</label>
            <input type="tel" id="no_telepon" name="no_telepon"
                   value="<?php echo $_POST['no_telepon'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                   value="<?php echo $_POST['email'] ?? ''; ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php?controller=tamu&action=index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>