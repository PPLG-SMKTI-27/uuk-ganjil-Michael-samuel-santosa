<?php
// Front Controller
session_start();

// Error handling for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load database config early
require_once __DIR__ . '/../config/DatabaseConfig.php';

// Autoload controllers, models, and config classes
function autoload($className) {
    // Try controllers first
    $file = __DIR__ . '/../app/controllers/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    // Try models
    $file = __DIR__ . '/../app/models/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    // Try config
    $file = __DIR__ . '/../config/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
}

spl_autoload_register('autoload');

// Route handling
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

// Check authentication for protected routes
$auth = new AuthController();
if ($controller !== 'auth' && $action !== 'login') {
    $auth->checkAuth();
}

// Route mapping
switch ($controller) {
    case 'auth':
        $authController = new AuthController();
        if ($action === 'login') {
            $authController->login();
        } elseif ($action === 'logout') {
            $authController->logout();
        }
        break;
        
    case 'dashboard':
        $dashboardController = new DashboardController();
        if ($action === 'index') {
            $dashboardController->index();
        }
        break;
        
    case 'tamu':
        $tamuController = new TamuController();
        switch ($action) {
            case 'index':
                $tamuController->index();
                break;
            case 'create':
                $tamuController->create();
                break;
            case 'edit':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $tamuController->edit($id);
                }
                break;
            case 'delete':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $tamuController->delete($id);
                }
                break;
        }
        break;
        
    default:
        header('HTTP/1.0 404 Not Found');
        echo 'Halaman tidak ditemukan';
        break;
}
?>