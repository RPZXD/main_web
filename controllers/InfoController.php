<?php
// controllers/InfoController.php
// Manages retrieval and rendering of real-time school statistics and administrative settings

class InfoController {
    private $infoModel;

    public function __construct() {
        $this->infoModel = new Info();
    }

    /**
     * Renders public School Information Dashboard page
     */
    public function index() {
        $generalStats = $this->infoModel->getGeneralStats();
        $studentStats = $this->infoModel->getStudentStats();
        $teacherStats = $this->infoModel->getTeacherStats();

        // Page title
        $title = __('info_dashboard_title') . " | " . SCHOOL_NAME;

        // Render views
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/info.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }

    /**
     * Handles administrative post requests to update school statistics configurations
     */
    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verify authentication and administrator role
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้ หรือเซสชันหมดอายุ กรุณาเข้าสู่ระบบ';
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Keys of general stats we support updating
            $statKeys = [
                'founded_date_th',
                'founded_date_en',
                'education_levels_th',
                'education_levels_en',
                'address_th',
                'address_en',
                'phone',
                'email',
                'coordinator_th',
                'coordinator_en'
            ];

            $successCount = 0;
            foreach ($statKeys as $key) {
                if (isset($_POST[$key])) {
                    $value = trim($_POST[$key]);
                    if ($this->infoModel->updateGeneralStat($key, $value)) {
                        $successCount++;
                    }
                }
            }

            if ($successCount > 0) {
                $_SESSION['success'] = 'บันทึกข้อมูลสารสนเทศโรงเรียนเรียบร้อยแล้ว';
            } else {
                $_SESSION['error'] = 'ไม่มีการแก้ไขข้อมูล หรือเกิดข้อผิดพลาดในการบันทึก';
            }
        }

        header('Location: ' . BASE_URL . 'admin?tab=stats');
        exit();
    }
}
