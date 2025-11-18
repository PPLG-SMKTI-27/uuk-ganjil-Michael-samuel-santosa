<?php
require_once __DIR__ . '/../models/Tamu.php';

class TamuController {
    private $tamuModel;

    public function __construct() {
        $this->tamuModel = new Tamu();
    }

    public function index() {
        $keyword = $_GET['search'] ?? '';
        
        if (!empty($keyword)) {
            $tamu = $this->tamuModel->search($keyword);
        } else {
            $tamu = $this->tamuModel->getAll();
        }

        $data = [
            'tamu' => $tamu,
            'keyword' => $keyword
        ];
        
        require __DIR__ . '/../views/tamu/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama' => trim($_POST['nama']),
                'instansi' => trim($_POST['instansi']),
                'keperluan' => trim($_POST['keperluan']),
                'tanggal_bertemu' => trim($_POST['tanggal_bertemu']),
                'no_telepon' => trim($_POST['no_telepon']),
                'email' => trim($_POST['email'])
            ];

            // Validate required fields
            $errors = [];
            if (empty($data['nama'])) $errors[] = 'Nama wajib diisi.';
            if (empty($data['keperluan'])) $errors[] = 'Keperluan wajib diisi.';
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email tidak valid.';
            if (!preg_match('/^[0-9]{10,15}$/', $data['no_telepon'])) $errors[] = 'Nomor telepon tidak valid.';

            if (!empty($errors)) {
                $error = implode(' ', $errors);
                require __DIR__ . '/../views/tamu/create.php';
                return;
            }

            if ($this->tamuModel->create($data)) {
                $_SESSION['flash_success'] = 'Data tamu berhasil ditambahkan!';
                header('Location: index.php?controller=tamu&action=index');
                exit;
            } else {
                $error = 'Gagal menambahkan data tamu!';
                require __DIR__ . '/../views/tamu/create.php';
            }
        } else {
            require __DIR__ . '/../views/tamu/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama' => trim($_POST['nama']),
                'instansi' => trim($_POST['instansi']),
                'keperluan' => trim($_POST['keperluan']),
                'tanggal_bertemu' => trim($_POST['tanggal_bertemu']),
                'no_telepon' => trim($_POST['no_telepon']),
                'email' => trim($_POST['email'])
            ];

            // Validate required fields
            $errors = [];
            if (empty($data['nama'])) $errors[] = 'Nama wajib diisi.';
            if (empty($data['keperluan'])) $errors[] = 'Keperluan wajib diisi.';
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email tidak valid.';
            if (!preg_match('/^[0-9]{10,15}$/', $data['no_telepon'])) $errors[] = 'Nomor telepon tidak valid.';

            if (!empty($errors)) {
                $error = implode(' ', $errors);
                $tamu = $this->tamuModel->getById($id);
                require __DIR__ . '/../views/tamu/edit.php';
                return;
            }

            if ($this->tamuModel->update($id, $data)) {
                $_SESSION['flash_success'] = 'Data tamu berhasil diperbarui!';
                header('Location: index.php?controller=tamu&action=index');
                exit;
            } else {
                $error = 'Gagal mengupdate data tamu!';
                $tamu = $this->tamuModel->getById($id);
                require __DIR__ . '/../views/tamu/edit.php';
            }
        } else {
            $tamu = $this->tamuModel->getById($id);
            if (!$tamu) {
                header('Location: index.php?controller=tamu&action=index&error=1');
                exit;
            }
            require __DIR__ . '/../views/tamu/edit.php';
        }
    }

    public function delete($id) {
        // Only allow admins to delete entries
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=tamu&action=index&error=unauthorized');
            exit;
        }

        if ($this->tamuModel->delete($id)) {
            header('Location: index.php?controller=tamu&action=index&success=1');
            exit;
        } else {
            header('Location: index.php?controller=tamu&action=index&error=1');
            exit;
        }
    }
}
?>