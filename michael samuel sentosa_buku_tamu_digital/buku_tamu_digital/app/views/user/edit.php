<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container">
    <h1>Edit Pengguna</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" class="form">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($data['user']['username']); ?>">
        </div>

        <div class="form-group">
            <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="staff" <?php echo ($data['user']['role'] === 'staff') ? 'selected' : ''; ?>>Staff</option>
                <option value="admin" <?php echo ($data['user']['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php?controller=user&action=index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
