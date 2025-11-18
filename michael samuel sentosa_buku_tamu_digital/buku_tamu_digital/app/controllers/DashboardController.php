<?php
require_once __DIR__ . '/../models/Tamu.php';

class DashboardController {
    private $tamuModel;

    public function __construct() {
        $this->tamuModel = new Tamu();
    }

    public function index() {
        $data = [
            'totalTamu' => $this->tamuModel->countAll(),
            'recentTamu' => $this->tamuModel->getRecent(5)
        ];
        require __DIR__ . '/../views/dashboard/index.php';
    }
}
?>