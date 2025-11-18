<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital - SMK TI Airlangga</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo" aria-label="Buku Tamu Digital">Buku Tamu Digital</a>
                <nav class="nav">
                    <a href="index.php?controller=dashboard&action=index">Dashboard</a>
                    <a href="index.php?controller=tamu&action=index">Data Tamu</a>
                    <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="index.php?controller=user&action=index">Manajemen User</a>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['username'])): ?>
                        <span class="user-info">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>)</span>
                        <a href="index.php?controller=auth&action=logout" class="logout">Logout</a>
                    <?php else: ?>
                        <a href="index.php?controller=auth&action=login">Login</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">