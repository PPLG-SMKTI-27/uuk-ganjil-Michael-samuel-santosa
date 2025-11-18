<?php
require_once __DIR__ . '/Database.php';

class Tamu {
    private $db;
    private $table = 'tamu';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Create
    public function create($data) {
        $query = "INSERT INTO {$this->table} (nama, instansi, keperluan, tanggal_bertemu, no_telepon, email, created_at) 
                  VALUES (:nama, :instansi, :keperluan, :tanggal_bertemu, :no_telepon, :email, NOW())";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    // Read All
    public function getAll() {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Read Single
    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    // Update
    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET 
                  nama = :nama, 
                  instansi = :instansi, 
                  keperluan = :keperluan, 
                  tanggal_bertemu = :tanggal_bertemu, 
                  no_telepon = :no_telepon, 
                  email = :email,
                  updated_at = NOW()
                  WHERE id = :id";
        
        $data['id'] = $id;
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    // Delete
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    // Count total tamu
    public function countAll() {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetch()['total'];
    }

    // Get recent tamu
    public function getRecent($limit = 5) {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Search tamu
    public function search($keyword) {
        $query = "SELECT * FROM {$this->table} 
                  WHERE nama LIKE :keyword 
                  OR instansi LIKE :keyword 
                  OR keperluan LIKE :keyword 
                  ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $searchTerm = "%$keyword%";
        $stmt->bindParam(':keyword', $searchTerm);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
?>