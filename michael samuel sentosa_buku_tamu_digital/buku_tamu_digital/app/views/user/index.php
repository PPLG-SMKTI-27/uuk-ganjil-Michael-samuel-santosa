<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container">
    <div class="header-actions">
        <h1>Manajemen Pengguna</h1>
        <a href="index.php?controller=user&action=create" class="btn btn-primary">Tambah Pengguna</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Operasi berhasil.</div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">Terjadi kesalahan: <?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $u): ?>
                <tr>
                    <td><?php echo htmlspecialchars($u['id']); ?></td>
                    <td><?php echo htmlspecialchars($u['username']); ?></td>
                    <td><?php echo htmlspecialchars($u['role']); ?></td>
                    <td><?php echo htmlspecialchars($u['created_at']); ?></td>
                    <td class="actions">
                        <a href="index.php?controller=user&action=edit&id=<?php echo $u['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="index.php?controller=user&action=delete&id=<?php echo $u['id']; ?>" class="btn btn-delete" onclick="return confirm('Hapus user ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
