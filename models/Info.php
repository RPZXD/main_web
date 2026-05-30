<?php
// models/Info.php
// Manages real-time data retrieval for student, teacher, and school statistics

class Info {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Retrieves all settings from the school_statistics table mapped by key
     * @return array
     */
    public function getGeneralStats() {
        try {
            $stmt = $this->db->query("SELECT stat_key, stat_value, label_th, label_en, category FROM school_statistics");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $stats = [];
            foreach ($results as $row) {
                $stats[$row['stat_key']] = $row;
            }
            return $stats;
        } catch (PDOException $e) {
            error_log("Error in getGeneralStats: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Update a statistic value by key
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function updateGeneralStat($key, $value) {
        try {
            $stmt = $this->db->prepare("UPDATE school_statistics SET stat_value = :value WHERE stat_key = :key");
            return $stmt->execute([
                'value' => $value,
                'key' => $key
            ]);
        } catch (PDOException $e) {
            error_log("Error in updateGeneralStat for key '$key': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Retrieves live student statistics grouped by grade (Stu_major) and program type
     * @return array
     */
    public function getStudentStats() {
        try {
            // We group active students (Stu_status = 1) by grade (Stu_major) and room (Stu_room)
            // Rooms 1 and 2 are ESC (Special), others are Regular.
            $stmt = $this->db->query("
                SELECT Stu_major, Stu_room, COUNT(*) as cnt 
                FROM phichaia_student.student 
                WHERE Stu_status = 1 
                GROUP BY Stu_major, Stu_room
                ORDER BY Stu_major ASC
            ");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Initialize structure for M.1 - M.6 (major 1 to 6)
            $grades = [];
            for ($i = 1; $i <= 6; $i++) {
                $grades[$i] = [
                    'grade' => $i,
                    'special' => 0,
                    'regular' => 0,
                    'total' => 0
                ];
            }

            foreach ($rows as $row) {
                $major = (int)$row['Stu_major'];
                if ($major < 1 || $major > 6) {
                    continue; // Skip any invalid major values outside 1-6
                }
                $room = (int)$row['Stu_room'];
                $count = (int)$row['cnt'];

                if ($room === 1 || $room === 2) {
                    $grades[$major]['special'] += $count;
                } else {
                    $grades[$major]['regular'] += $count;
                }
                $grades[$major]['total'] += $count;
            }

            return $grades;
        } catch (PDOException $e) {
            error_log("Error in getStudentStats: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Retrieves live teacher and staff statistics grouped by Academic Rank (Teach_Academic)
     * @return array
     */
    public function getTeacherStats() {
        try {
            // Group active teachers (Teach_status = 1)
            $stmt = $this->db->query("
                SELECT Teach_Academic, COUNT(*) as cnt 
                FROM phichaia_student.teacher 
                WHERE Teach_status = 1 
                GROUP BY Teach_Academic
            ");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $ranks = [
                'assistant' => 0, // Teach_Academic = '0'
                'teacher1' => 0,  // Teach_Academic = '1'
                'level2' => 0,    // Teach_Academic = '2' (ครู ค.ศ. 2 / ชำนาญการ)
                'level3' => 0,    // Teach_Academic = '5' (ครู ค.ศ. 3 / ชำนาญการพิเศษ)
                'other' => 0,     // other values or empty
                'total' => 0
            ];

            foreach ($rows as $row) {
                $academic = trim($row['Teach_Academic']);
                $count = (int)$row['cnt'];
                $ranks['total'] += $count;

                if ($academic === '0') {
                    $ranks['assistant'] += $count;
                } elseif ($academic === '1') {
                    $ranks['teacher1'] += $count;
                } elseif ($academic === '2') {
                    $ranks['level2'] += $count;
                } elseif ($academic === '5') {
                    $ranks['level3'] += $count;
                } else {
                    $ranks['other'] += $count;
                }
            }

            return $ranks;
        } catch (PDOException $e) {
            error_log("Error in getTeacherStats: " . $e->getMessage());
            return [];
        }
    }
}
