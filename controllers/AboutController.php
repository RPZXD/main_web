<?php
// controllers/AboutController.php
// Manages loading and rendering of school profile details

class AboutController {
    private $aboutModel;

    public function __construct() {
        $this->aboutModel = new About();
    }

    /**
     * Renders unified sidebar-based About School info page
     */
    public function index() {
        // Fetch static sections and executive records
        $sections = $this->aboutModel->getAllSections();
        $executives = $this->aboutModel->getExecutives();

        // Establish active tab, default to 'history'
        $allowedTabs = ['history', 'vision_mission', 'symbol', 'colors', 'song', 'executives', 'structure'];
        $activeTab = trim($_GET['tab'] ?? 'history');
        if (!in_array($activeTab, $allowedTabs)) {
            $activeTab = 'history';
        }

        $title = __('about_school') . " | " . SCHOOL_NAME;
        
        // Render MVC views
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/about.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }

    /**
     * Renders public Contact Us page view
     */
    public function contact() {
        $title = __('contact_us') . " | " . SCHOOL_NAME;

        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/contact.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }

    /**
     * Handles administrative post requests to update school info sections
     */
    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $key = trim($_POST['section_key'] ?? '');
            $contentTh = $_POST['content_th'] ?? '';
            $contentEn = $_POST['content_en'] ?? '';

            if (empty($key)) {
                $_SESSION['error'] = 'ข้อมูลไม่ครบถ้วน';
            } else {
                $success = $this->aboutModel->updateSection($key, $contentTh, $contentEn);
                if ($success) {
                    $_SESSION['success'] = 'บันทึกข้อมูลแนะนำโรงเรียนเรียบร้อยแล้ว';
                } else {
                    $_SESSION['error'] = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล';
                }
            }
        }
        header('Location: ' . BASE_URL . 'admin?tab=about');
        exit();
    }
}
