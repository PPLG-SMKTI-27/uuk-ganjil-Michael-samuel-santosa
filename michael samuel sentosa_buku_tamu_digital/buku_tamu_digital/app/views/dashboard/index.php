<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="dashboard">
    <h1>Dashboard</h1>
    
    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Tamu</h3>
            <div class="stat-number"><?php echo htmlspecialchars($data['totalTamu']); ?></div>
        </div>
    </div>

    <div class="recent-tamu">
        <h2>Tamu Terbaru</h2>
        <?php if (empty($data['recentTamu'])): ?>
            <p class="no-data">Belum ada data tamu</p>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Keperluan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['recentTamu'] as $tamu): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tamu['nama']); ?></td>
                            <td><?php echo htmlspecialchars($tamu['instansi']); ?></td>
                            <td><?php echo htmlspecialchars($tamu['keperluan']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($tamu['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>