<?php
// controllers/AdminSettingController.php
// Manages security authorization and data configuration for system settings

class AdminSettingController {
    private $settingModel;

    public function __construct() {
        // Enforce administrative privileges check
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้ หรือเซสชันหมดอายุ กรุณาเข้าสู่ระบบ';
            header('Location: ' . BASE_URL . 'login');
            exit();
        }
        $this->settingModel = new Setting();
    }

    /**
     * Renders site configurations management dashboard form view
     */
    public function index() {
        $settings = $this->settingModel->get_all_settings();
        
        // Page Title & Dashboard Active Tab
        $title = "ตั้งค่าเว็บไซต์ระบบโรงเรียน | " . SCHOOL_NAME;
        
        require ROOT_PATH . 'views/admin/settings.php';
    }

    /**
     * Receives POST configurations payload and writes to DB
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/settings');
            exit();
        }

        // 1. Sanitize standard string inputs
        $textSettings = [
            'school_name' => trim($_POST['school_name'] ?? ''),
            'school_name_en' => trim($_POST['school_name_en'] ?? ''),
            'school_short_name' => trim($_POST['school_short_name'] ?? ''),
            'school_address_th' => trim($_POST['school_address_th'] ?? ''),
            'school_address_en' => trim($_POST['school_address_en'] ?? ''),
            'school_phone' => trim($_POST['school_phone'] ?? ''),
            'school_fax' => trim($_POST['school_fax'] ?? ''),
            'school_email' => trim($_POST['school_email'] ?? ''),
            'school_facebook' => trim($_POST['school_facebook'] ?? ''),
            'school_youtube' => trim($_POST['school_youtube'] ?? ''),
            'school_line' => trim($_POST['school_line'] ?? ''),
            'google_map_embed' => trim($_POST['google_map_embed'] ?? ''),
            'stat_students' => trim($_POST['stat_students'] ?? ''),
            'stat_students_sub' => trim($_POST['stat_students_sub'] ?? ''),
            'stat_teachers' => trim($_POST['stat_teachers'] ?? ''),
            'stat_teachers_sub' => trim($_POST['stat_teachers_sub'] ?? ''),
            'stat_awards' => trim($_POST['stat_awards'] ?? ''),
            'stat_awards_sub' => trim($_POST['stat_awards_sub'] ?? ''),
            'stat_admission' => trim($_POST['stat_admission'] ?? ''),
            'stat_admission_sub' => trim($_POST['stat_admission_sub'] ?? ''),
            'exec_name' => trim($_POST['exec_name'] ?? ''),
            'exec_position' => trim($_POST['exec_position'] ?? ''),
            'exec_message' => trim($_POST['exec_message'] ?? '')
        ];

        // Perform XSS cleaning for key text inputs
        foreach ($textSettings as $key => $val) {
            $textSettings[$key] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
        }

        $allSettings = $this->settingModel->get_all_settings();
        $uploadErrors = [];

        // 2. Handle System Logo Image File Upload
        if (isset($_FILES['school_logo']) && $_FILES['school_logo']['error'] === UPLOAD_ERR_OK) {
            $logoFile = $_FILES['school_logo'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($fileInfo, $logoFile['tmp_name']);
            finfo_close($fileInfo);

            if (!in_array($mimeType, $allowedTypes)) {
                $uploadErrors[] = 'รูปภาพโลโก้โรงเรียนต้องเป็นไฟล์สกุล .jpg, .png หรือ .webp เท่านั้น';
            } elseif ($logoFile['size'] > 5 * 1024 * 1024) { // 5MB limit
                $uploadErrors[] = 'รูปภาพโลโก้โรงเรียนต้องมีขนาดไม่เกิน 5MB';
            } else {
                // Determine file extension
                $ext = 'png';
                if ($mimeType === 'image/jpeg') $ext = 'jpg';
                if ($mimeType === 'image/webp') $ext = 'webp';

                // Create folder if not exists
                if (!is_dir(UPLOAD_DIR)) {
                    mkdir(UPLOAD_DIR, 0777, true);
                }

                // Make unique name
                $fileName = 'logo_' . time() . '.' . $ext;
                $destination = UPLOAD_DIR . $fileName;

                if (move_uploaded_file($logoFile['tmp_name'], $destination)) {
                    // Update setting database entry
                    $this->settingModel->update_setting('school_logo', $fileName);
                    
                    // Cleanup old file
                    if (!empty($allSettings['school_logo'])) {
                        $oldFile = UPLOAD_DIR . $allSettings['school_logo'];
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                } else {
                    $uploadErrors[] = 'ไม่สามารถบันทึกไฟล์โลโก้โรงเรียนลงระบบได้';
                }
            }
        }

        // 3. Handle System Favicon File Upload
        if (isset($_FILES['school_favicon']) && $_FILES['school_favicon']['error'] === UPLOAD_ERR_OK) {
            $faviconFile = $_FILES['school_favicon'];
            $allowedTypes = ['image/x-icon', 'image/vnd.microsoft.icon', 'image/png', 'image/jpeg', 'image/gif'];
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($fileInfo, $faviconFile['tmp_name']);
            finfo_close($fileInfo);

            if (!in_array($mimeType, $allowedTypes) && substr($faviconFile['name'], -4) !== '.ico') {
                $uploadErrors[] = 'รูปภาพ Favicon ต้องเป็นไฟล์สกุล .ico, .png, .gif หรือ .jpg เท่านั้น';
            } elseif ($faviconFile['size'] > 2 * 1024 * 1024) { // 2MB limit
                $uploadErrors[] = 'รูปภาพ Favicon ต้องมีขนาดไม่เกิน 2MB';
            } else {
                // Determine file extension
                $ext = pathinfo($faviconFile['name'], PATHINFO_EXTENSION);
                if (empty($ext)) $ext = 'ico';

                // Create folder if not exists
                if (!is_dir(UPLOAD_DIR)) {
                    mkdir(UPLOAD_DIR, 0777, true);
                }

                // Make unique name
                $fileName = 'favicon_' . time() . '.' . $ext;
                $destination = UPLOAD_DIR . $fileName;

                if (move_uploaded_file($faviconFile['tmp_name'], $destination)) {
                    // Update setting database entry
                    $this->settingModel->update_setting('school_favicon', $fileName);
                    
                    // Cleanup old file
                    if (!empty($allSettings['school_favicon'])) {
                        $oldFile = UPLOAD_DIR . $allSettings['school_favicon'];
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                } else {
                    $uploadErrors[] = 'ไม่สามารถบันทึกไฟล์ Favicon ลงระบบได้';
                }
            }
        }

        // 3.1 Handle Executive Image File Upload
        if (isset($_FILES['exec_image']) && $_FILES['exec_image']['error'] === UPLOAD_ERR_OK) {
            $execImage = $_FILES['exec_image'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($fileInfo, $execImage['tmp_name']);
            finfo_close($fileInfo);

            if (!in_array($mimeType, $allowedTypes)) {
                $uploadErrors[] = 'รูปภาพผู้บริหารต้องเป็นไฟล์สกุล .jpg, .png หรือ .webp เท่านั้น';
            } elseif ($execImage['size'] > 5 * 1024 * 1024) { // 5MB limit
                $uploadErrors[] = 'รูปภาพผู้บริหารต้องมีขนาดไม่เกิน 5MB';
            } else {
                $ext = 'png';
                if ($mimeType === 'image/jpeg') $ext = 'jpg';
                if ($mimeType === 'image/webp') $ext = 'webp';

                if (!is_dir(UPLOAD_DIR)) {
                    mkdir(UPLOAD_DIR, 0777, true);
                }

                $fileName = 'exec_' . time() . '.' . $ext;
                $destination = UPLOAD_DIR . $fileName;

                if (move_uploaded_file($execImage['tmp_name'], $destination)) {
                    $this->settingModel->update_setting('exec_image', $fileName);
                    
                    if (!empty($allSettings['exec_image'])) {
                        $oldFile = UPLOAD_DIR . $allSettings['exec_image'];
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                } else {
                    $uploadErrors[] = 'ไม่สามารถบันทึกไฟล์รูปภาพผู้บริหารลงระบบได้';
                }
            }
        }

        // 4. Update text properties settings in database
        foreach ($textSettings as $key => $value) {
            $this->settingModel->update_setting($key, $value);
        }

        // 5. Setup session notifications status
        if (empty($uploadErrors)) {
            $_SESSION['success'] = 'บันทึกการตั้งค่าเว็บไซต์เรียบร้อยแล้ว';
        } else {
            $_SESSION['success'] = 'บันทึกการตั้งค่าตัวหนังสือเรียบร้อยแล้ว';
            $_SESSION['error'] = implode('<br>', $uploadErrors);
        }

        header('Location: ' . BASE_URL . 'admin/settings');
        exit();
    }
}
