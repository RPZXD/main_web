<?php
// controllers/UrgentNewsController.php
// Manages administrative CRUD for scrolling ticker news

class UrgentNewsController {
    private $urgentNewsModel;

    public function __construct() {
        $this->urgentNewsModel = new UrgentNews();
    }

    /**
     * Creates a new urgent news entry
     */
    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = trim($_POST['message'] ?? '');
            $linkUrl = trim($_POST['link_url'] ?? '');
            $isActive = (int)($_POST['is_active'] ?? 1);

            if (empty($message)) {
                $_SESSION['error'] = 'กรุณากรอกข้อความข่าวด่วน';
                header('Location: ' . BASE_URL . 'admin?tab=ticker');
                exit();
            }

            $success = $this->urgentNewsModel->create([
                'message' => $message,
                'link_url' => !empty($linkUrl) ? $linkUrl : null,
                'is_active' => $isActive
            ]);

            if ($success) {
                $_SESSION['success'] = 'เพิ่มข่าวด่วนใหม่เรียบร้อยแล้ว';
            } else {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการบันทึกข้อมูลข่าวด่วน';
            }
        }
        header('Location: ' . BASE_URL . 'admin?tab=ticker');
        exit();
    }

    /**
     * Updates an existing urgent news entry
     */
    public function edit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $message = trim($_POST['message'] ?? '');
            $linkUrl = trim($_POST['link_url'] ?? '');
            $isActive = (int)($_POST['is_active'] ?? 1);

            if (empty($message)) {
                $_SESSION['error'] = 'กรุณากรอกข้อความข่าวด่วน';
                header('Location: ' . BASE_URL . 'admin?tab=ticker');
                exit();
            }

            $success = $this->urgentNewsModel->update($id, [
                'message' => $message,
                'link_url' => !empty($linkUrl) ? $linkUrl : null,
                'is_active' => $isActive
            ]);

            if ($success) {
                $_SESSION['success'] = 'แก้ไขข้อมูลข่าวด่วนสำเร็จ';
            } else {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการปรับปรุงข้อมูลข่าวด่วน';
            }
        }
        header('Location: ' . BASE_URL . 'admin?tab=ticker');
        exit();
    }

    /**
     * Deletes an urgent news entry
     */
    public function delete() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        $id = (int)($_GET['id'] ?? 0);
        $success = $this->urgentNewsModel->delete($id);

        if ($success) {
            $_SESSION['success'] = 'ลบข้อมูลข่าวด่วนสำเร็จ';
        } else {
            $_SESSION['error'] = 'เกิดข้อผิดพลาดในการลบข่าวด่วน';
        }
        header('Location: ' . BASE_URL . 'admin?tab=ticker');
        exit();
    }

    /**
     * Toggles active state of ticker
     */
    public function toggleStatus() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        $id = (int)($_GET['id'] ?? 0);
        $ticker = $this->urgentNewsModel->getById($id);

        if ($ticker) {
            $newStatus = ($ticker['is_active'] == 1) ? 0 : 1;
            $success = $this->urgentNewsModel->update($id, [
                'message' => $ticker['message'],
                'link_url' => $ticker['link_url'],
                'is_active' => $newStatus
            ]);

            if ($success) {
                $_SESSION['success'] = 'เปลี่ยนสถานะข่าวด่วนสำเร็จ';
            } else {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการเปลี่ยนสถานะ';
            }
        }
        header('Location: ' . BASE_URL . 'admin?tab=ticker');
        exit();
    }
}
