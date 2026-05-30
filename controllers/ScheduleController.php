<?php
// controllers/ScheduleController.php
// Manages public access and view loading for class schedules

class ScheduleController {
    /**
     * Renders public Student Class Schedule page
     */
    public function student() {
        $scheduleType = 'student';
        $scheduleUrl = defined('STUDENT_SCHEDULE_LINK') ? STUDENT_SCHEDULE_LINK : '';
        $embedUrl = $this->getGoogleDriveEmbedUrl($scheduleUrl);
        $title = __('info_schedule_student') . " | " . SCHOOL_NAME;

        // Render views
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/schedule.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }

    /**
     * Renders public Teacher Class Schedule page
     */
    public function teacher() {
        $scheduleType = 'teacher';
        $scheduleUrl = defined('TEACHER_SCHEDULE_LINK') ? TEACHER_SCHEDULE_LINK : '';
        $embedUrl = $this->getGoogleDriveEmbedUrl($scheduleUrl);
        $title = __('info_schedule_teacher') . " | " . SCHOOL_NAME;

        // Render views
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/schedule.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }

    /**
     * Parse standard sharing links and turn them into iframe preview links
     */
    private function getGoogleDriveEmbedUrl($url) {
        $url = trim($url);
        
        // Match Google Drive folder pattern
        if (preg_match('/\/folders\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return "https://drive.google.com/embeddedfolderview?id=" . $matches[1] . "#grid";
        }
        
        // Match pattern: drive.google.com/file/d/(ID)/...
        if (preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return "https://drive.google.com/file/d/" . $matches[1] . "/preview";
        }
        // Match pattern: drive.google.com/open?id=(ID)
        if (preg_match('/id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return "https://drive.google.com/file/d/" . $matches[1] . "/preview";
        }
        return $url;
    }
}
