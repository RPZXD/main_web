<?php
// controllers/StudentController.php
// Manages logic and rendering for the public Student List print page

class StudentController {
    /**
     * Renders public Student List printable view
     */
    public function index() {
        $studentModel = new Student();
        $activeGroups = $studentModel->getActiveGroups();
        
        $classesData = [];
        foreach ($activeGroups as $group) {
            $c = $group['Stu_major'];
            $r = $group['Stu_room'];
            if (!isset($classesData[$c])) {
                $classesData[$c] = [];
            }
            $classesData[$c][] = $r;
        }

        // Fallback default classes and rooms if DB is empty
        if (empty($classesData)) {
            $classesData = [
                "1" => ["1", "2", "3", "4", "5"],
                "2" => ["1", "2", "3", "4", "5"],
                "3" => ["1", "2", "3", "4", "5"],
                "4" => ["1", "2", "3", "4", "5"],
                "5" => ["1", "2", "3", "4", "5"],
                "6" => ["1", "2", "3", "4", "5"]
            ];
        }

        $defaultPee = date('Y') + 543;
        $title = __('info_student_list') . " | " . SCHOOL_NAME;

        // Render layout
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/student_list.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }

    /**
     * AJAX action to retrieve student roster & advisors for selected class/room
     */
    public function ajaxGetStudents() {
        header('Content-Type: application/json');
        
        $class = isset($_GET['class']) ? trim($_GET['class']) : '';
        $room = isset($_GET['room']) ? trim($_GET['room']) : '';
        
        if (empty($class) || empty($room)) {
            echo json_encode([
                'success' => false, 
                'message' => 'กรุณาระบุระดับชั้นและห้องเรียน'
            ]);
            exit;
        }

        try {
            $studentModel = new Student();
            $students = $studentModel->getStudents($class, $room);
            $advisors = $studentModel->getAdvisors($class, $room);
            $year = date('Y') + 543;

            echo json_encode([
                'success' => true,
                'students' => $students,
                'advisors' => $advisors,
                'year' => $year
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการดึงข้อมูล: ' . $e->getMessage()
            ]);
        }
        exit;
    }
}
