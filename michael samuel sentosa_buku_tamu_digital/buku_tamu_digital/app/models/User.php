<?php
require_once __DIR__ . '/Database.php';

class User {
    private $db;
    private $table = 'users';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Authenticate user. Supports password_verify for modern hashes
     * and falls back to legacy MD5 comparison for seeded/older accounts.
     *
     * @param string $username
     * @param string $password Plain-text password to verify
     * @return array|false User row array on success, false on failure
     */
    public function authenticate($username, $password) {
        $query = "SELECT * FROM {$this->table} WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch();
        if (!$user) {
            return false;
        }

        // If stored password is using password_hash (bcrypt/argon2), verify it
        if (!empty($user['password']) && password_verify($password, $user['password'])) {
            return $user;
        }

        // Fallback: legacy MD5-hashed passwords (seeded data may use md5)
        if (!empty($user['password']) && $user['password'] === md5($password)) {
            return $user;
        }

        return false;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Get all users
    public function getAll() {
        $query = "SELECT id, username, role, created_at FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Create a new user (password will be hashed)
    public function createUser($data) {
        $hashed = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO {$this->table} (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':username' => $data['username'],
            ':password' => $hashed,
            ':role' => $data['role'] ?? 'staff'
        ]);
    }

    // Update user (if password provided, update it)
    public function updateUser($id, $data) {
        if (!empty($data['password'])) {
            $hashed = password_hash($data['password'], PASSWORD_DEFAULT);
            $query = "UPDATE {$this->table} SET username = :username, password = :password, role = :role WHERE id = :id";
            $params = [
                ':username' => $data['username'],
                ':password' => $hashed,
                ':role' => $data['role'] ?? 'staff',
                ':id' => $id
            ];
        } else {
            $query = "UPDATE {$this->table} SET username = :username, role = :role WHERE id = :id";
            $params = [
                ':username' => $data['username'],
                ':role' => $data['role'] ?? 'staff',
                ':id' => $id
            ];
        }

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    // Delete user
    public function deleteUser($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>