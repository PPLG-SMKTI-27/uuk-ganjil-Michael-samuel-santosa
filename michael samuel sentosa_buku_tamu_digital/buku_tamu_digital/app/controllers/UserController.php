<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // List users (admin only)
    public function index() {
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $users = $this->userModel->getAll();
        $data = ['users' => $users];
        require __DIR__ . '/../views/user/index.php';
    }

    // Create user
    public function create() {
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'staff';

            if ($username === '' || $password === '') {
                $error = 'Username dan password wajib diisi.';
                require __DIR__ . '/../views/user/create.php';
                return;
            }

            $ok = $this->userModel->createUser([
                'username' => $username,
                'password' => $password,
                'role' => $role
            ]);

            if ($ok) {
                header('Location: index.php?controller=user&action=index&success=1');
                exit;
            } else {
                $error = 'Gagal membuat user baru.';
                require __DIR__ . '/../views/user/create.php';
                return;
            }
        }

        require __DIR__ . '/../views/user/create.php';
    }

    // Edit user
    public function edit($id) {
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            header('Location: index.php?controller=user&action=index&error=notfound');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'staff';

            if ($username === '') {
                $error = 'Username wajib diisi.';
                require __DIR__ . '/../views/user/edit.php';
                return;
            }

            $ok = $this->userModel->updateUser($id, [
                'username' => $username,
                'password' => $password,
                'role' => $role
            ]);

            if ($ok) {
                header('Location: index.php?controller=user&action=index&success=1');
                exit;
            } else {
                $error = 'Gagal mengupdate user.';
                require __DIR__ . '/../views/user/edit.php';
                return;
            }
        }

        $data = ['user' => $user];
        require __DIR__ . '/../views/user/edit.php';
    }

    // Delete user
    public function delete($id) {
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        // Prevent deleting currently logged-in admin
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
            header('Location: index.php?controller=user&action=index&error=own');
            exit;
        }

        $this->userModel->deleteUser($id);
        header('Location: index.php?controller=user&action=index&success=1');
        exit;
    }
}

?>
