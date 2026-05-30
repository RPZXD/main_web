<?php
// controllers/StaffController.php
// Manages loading and rendering of school staff categorized by department tabs

class StaffController {
    /**
     * Renders public School Staff categorized directories
     */
    public function index() {
        // Query teachers from phichaia_student database
        try {
            $studentModel = new Student(); // Triggers autoload
            $db = Student::connect(); // Reuse PDO connection from Student Model
            
            // Query active staff/teachers
            $stmt = $db->query("SELECT Teach_id, Teach_name, Teach_major, Teach_photo, Teach_sex, Teach_phone, Teach_email, Teach_Position2, Teach_Academic 
                                FROM teacher 
                                WHERE Teach_status = '1' 
                                ORDER BY CAST(Teach_id AS UNSIGNED) ASC, Teach_name ASC");
            $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Failed to fetch staff list: " . $e->getMessage());
            $teachers = [];
        }

        // Define categorizations mapping (11 categories/departments)
        $categorizedStaff = [
            'executive' => [],      // ผู้บริหารโรงเรียน
            'thai' => [],           // กลุ่มสาระภาษาไทย
            'math' => [],           // กลุ่มสาระคณิตศาสตร์
            'science' => [],        // กลุ่มสาระวิทยาศาสตร์และเทคโนโลยี
            'social' => [],         // กลุ่มสาระสังคมศึกษาฯ
            'health' => [],         // กลุ่มสาระสุขศึกษาและพลศึกษา
            'arts' => [],           // กลุ่มสาระศิลปะ
            'career' => [],         // กลุ่มสาระการงานอาชีพฯ
            'foreign' => [],        // กลุ่มสาระภาษาต่างประเทศ
            'development' => [],    // กิจกรรมพัฒนาผู้เรียน
            'support' => []         // เจ้าหน้าที่ พนักงาน
        ];

        foreach ($teachers as $t) {
            $major = trim($t['Teach_major'] ?? '');
            $pos2 = trim($t['Teach_Position2'] ?? '');

            if ($pos2 === 'ผู้บริหาร' || $major === 'ผู้อำนวยการ' || $major === 'รองผู้อำนวยการ') {
                $categorizedStaff['executive'][] = $t;
            } elseif ($major === 'ภาษาไทย') {
                $categorizedStaff['thai'][] = $t;
            } elseif ($major === 'คณิตศาสตร์') {
                $categorizedStaff['math'][] = $t;
            } elseif ($major === 'วิทยาศาสตร์' || $major === 'คอมพิวเตอร์') {
                $categorizedStaff['science'][] = $t;
            } elseif ($major === 'สังคมศึกษา ศาสนา และวัฒนธรรม') {
                $categorizedStaff['social'][] = $t;
            } elseif ($major === 'สุขศึกษาและพลศึกษา') {
                $categorizedStaff['health'][] = $t;
            } elseif ($major === 'ศิลปะ') {
                $categorizedStaff['arts'][] = $t;
            } elseif ($major === 'การงานอาชีพ') {
                $categorizedStaff['career'][] = $t;
            } elseif ($major === 'ภาษาต่างประเทศ') {
                $categorizedStaff['foreign'][] = $t;
            } elseif ($major === 'กิจกรรมพัฒนาผู้เรียน') {
                $categorizedStaff['development'][] = $t;
            } else {
                // If it matches Support/Worker majors like 'นักการภารโรง', 'แม่บ้าน', etc.
                $categorizedStaff['support'][] = $t;
            }
        }

        $title = __('info_school_staff') . " | " . SCHOOL_NAME;

        // Render views
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/school_staff.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }
}
