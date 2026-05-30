<?php
// controllers/AttendanceController.php
// Controller for displaying daily student attendance statistics

class AttendanceController {
    /**
     * Renders public Daily Attendance Statistics page
     */
    public function index() {
        $attendanceModel = new Attendance();

        // Retrieve active academic term and year
        $term = $attendanceModel->getTerm();
        $year = $attendanceModel->getPee();

        // Get requested date, defaulting to today
        $date = isset($_GET['date']) ? trim($_GET['date']) : date('Y-m-d');

        // Fetch statistics from model
        $stats = $attendanceModel->getAttendanceStats($date, $term, $year);
        $studentCounts = $attendanceModel->getStudentCounts();
        $classAttendance = $attendanceModel->getClassAttendance($date, $term, $year);

        // Prepare data variables for the view
        $title = __('info_attendance_stats') . " | " . SCHOOL_NAME;
        $classes = $classAttendance['classes'];
        $status_count = $classAttendance['status_count'];
        $total = $classAttendance['total'];

        // Render views wrapped in layout header and footer
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/attendance_stats.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }
}
