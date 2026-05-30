<?php
// controllers/ItaController.php
// Manages display of ITA indicators for frontend and updates/file-uploads for administration

class ItaController {
    private $itaModel;

    public function __construct() {
        $this->itaModel = new Ita();
    }

    /**
     * Frontend ITA: Displays indicators table O1 - O43
     */
    public function index() {
        // Fetch all published indicators
        $itaItems = $this->itaModel->getAll('published');
        $itaMetrics = $this->itaModel->getMetrics();

        // Calculate progress percentage
        $progressPercent = $itaMetrics['total'] > 0 
            ? round(($itaMetrics['completed'] / $itaMetrics['total']) * 100, 1) 
            : 0;

        $title = "ศูนย์ข้อมูล ITA Online | " . SCHOOL_NAME;
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/ita.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }

    /**
     * Handles administrative updates of ITA items (AJAX/Direct POST)
     */
    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Guard access
        if (!isset($_SESSION['user_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = trim($_POST['code'] ?? '');
            $name = trim($_POST['name'] ?? '');
            $linkUrl = trim($_POST['link_url'] ?? '');
            $status = trim($_POST['status'] ?? 'published');

            // Find current model item state
            $currentItem = $this->itaModel->getByCode($code);
            if (!$currentItem) {
                $_SESSION['error'] = 'ไม่พบรหัสตัวชี้วัดดังกล่าว';
                header('Location: ' . BASE_URL . 'admin?tab=ita');
                exit();
            }

            $filePath = $currentItem['file_path'];

            // Handle file upload if present
            if (isset($_FILES['ita_file']) && $_FILES['ita_file']['error'] === UPLOAD_ERR_OK) {
                $uploadedFilePath = $this->handleFileUpload($_FILES['ita_file'], $code);
                if ($uploadedFilePath) {
                    $filePath = $uploadedFilePath;
                    // Delete previous file if exists to clean space
                    if (!empty($currentItem['file_path'])) {
                        $oldPath = str_replace(UPLOAD_URL, UPLOAD_DIR, $currentItem['file_path']);
                        if (file_exists($oldPath)) {
                            @unlink($oldPath);
                        }
                    }
                } else {
                    $_SESSION['error'] = 'การอัปโหลดไฟล์ล้มเหลว (กรุณาใช้ไฟล์ PDF, Excel, Word หรือ Zip ขนาดไม่เกิน 15MB)';
                    header('Location: ' . BASE_URL . 'admin?tab=ita');
                    exit();
                }
            }

            // If user checked "Clear current file", remove PDF file link
            if (isset($_POST['clear_file']) && $_POST['clear_file'] == '1') {
                if (!empty($currentItem['file_path'])) {
                    $oldPath = str_replace(UPLOAD_URL, UPLOAD_DIR, $currentItem['file_path']);
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $filePath = null;
            }

            $success = $this->itaModel->update($code, [
                'name' => $name,
                'link_url' => $linkUrl,
                'file_path' => $filePath,
                'status' => $status
            ]);

            if ($success) {
                $_SESSION['success'] = 'ปรับปรุงตัวชี้วัด ' . $code . ' สำเร็จแล้ว';
            } else {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการบันทึกตัวชี้วัด';
            }
        }

        header('Location: ' . BASE_URL . 'admin?tab=ita');
        exit();
    }

    /**
     * Resets/clears the content of an ITA indicator
     */
    public function delete() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Guard access
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        $code = trim($_GET['code'] ?? '');
        if (empty($code)) {
            $_SESSION['error'] = 'ไม่ได้ระบุรหัสตัวชี้วัด';
            header('Location: ' . BASE_URL . 'admin?tab=ita');
            exit();
        }

        $currentItem = $this->itaModel->getByCode($code);
        if (!$currentItem) {
            $_SESSION['error'] = 'ไม่พบรหัสตัวชี้วัดดังกล่าว';
            header('Location: ' . BASE_URL . 'admin?tab=ita');
            exit();
        }

        // Delete physical file if exists
        if (!empty($currentItem['file_path'])) {
            $oldPath = str_replace(UPLOAD_URL, UPLOAD_DIR, $currentItem['file_path']);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        // Clear database fields
        $success = $this->itaModel->update($code, [
            'name' => $currentItem['name'],
            'link_url' => '',
            'file_path' => null,
            'status' => 'draft'
        ]);

        if ($success) {
            $_SESSION['success'] = 'ลบข้อมูลของตัวชี้วัด ' . $code . ' เรียบร้อยแล้ว';
        } else {
            $_SESSION['error'] = 'เกิดข้อผิดพลาดในการลบข้อมูลตัวชี้วัด';
        }

        header('Location: ' . BASE_URL . 'admin?tab=ita');
        exit();
    }

    /**
     * Helper Method: Handles PDF/Document uploads securely
     * @param array $file $_FILES element
     * @param string $code indicator code (e.g. O1, O25)
     * @return string|false relative/absolute public URL of uploaded file
     */
    private function handleFileUpload($file, $code) {
        $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar'];
        $fileInfo = pathinfo($file['name']);
        $extension = strtolower($fileInfo['extension'] ?? '');

        if (!in_array($extension, $allowedExtensions)) {
            return false;
        }

        // Limit size to 15MB
        if ($file['size'] > 15 * 1024 * 1024) {
            return false;
        }

        // Ensure target directory exists
        if (!file_exists(UPLOAD_DIR)) {
            mkdir(UPLOAD_DIR, 0755, true);
        }

        // Generate clean filename
        $newFilename = 'ita_' . $code . '_' . time() . '.' . $extension;
        $destination = UPLOAD_DIR . $newFilename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return UPLOAD_URL . $newFilename;
        }

        return false;
    }
}
