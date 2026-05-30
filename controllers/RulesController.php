<?php
// controllers/RulesController.php
// Controller for displaying student handbook and school regulations PDF views

class RulesController {
    /**
     * Renders Student Handbook page
     */
    public function studentHandbook() {
        $pdfFile = 'คู่มือนักเรียนและผู้ปกครอง.pdf';
        $title = __('info_handbook_student') . " | " . SCHOOL_NAME;
        $categoryKey = 'cat_rules_handbook';
        $pageTitleKey = 'info_handbook_student';
        $description = 'คู่มือนักเรียนและผู้ปกครองอย่างเป็นทางการของโรงเรียนพิชัย เพื่อความเข้าใจแนวทางการศึกษาและการอยู่ร่วมกันในโรงเรียน';
        
        $this->renderPdfView($pdfFile, $title, $categoryKey, $pageTitleKey, $description);
    }

    /**
     * Renders Discipline Rules page
     */
    public function disciplineRules() {
        $pdfFile = 'ระเบียบโรงเรียนพิชัย 2568.pdf';
        $title = __('info_discipline_rules') . " | " . SCHOOL_NAME;
        $categoryKey = 'cat_rules_handbook';
        $pageTitleKey = 'info_discipline_rules';
        $description = 'กฎระเบียบวินัยและความประพฤติของนักเรียนโรงเรียนพิชัย ประจำปีการศึกษา 2568 เพื่อความเป็นระเบียบเรียบร้อยและความปลอดภัย';
        
        $this->renderPdfView($pdfFile, $title, $categoryKey, $pageTitleKey, $description);
    }

    /**
     * Renders Dress and Haircut Rules page
     */
    public function dressRules() {
        $pdfFile = 'ประกาศโรงเรียนพิชัย-ว่าด้วยทรงผม2566_230509_113401.pdf';
        $title = __('info_dress_rules') . " | " . SCHOOL_NAME;
        $categoryKey = 'cat_rules_handbook';
        $pageTitleKey = 'info_dress_rules';
        $description = 'ประกาศกฎระเบียบของโรงเรียนว่าด้วยเรื่องเครื่องแต่งกายและทรงผมนักเรียน เพื่อสร้างบุคลิกภาพที่ดีและถูกต้องตามระเบียบโรงเรียน';
        
        $this->renderPdfView($pdfFile, $title, $categoryKey, $pageTitleKey, $description);
    }

    /**
     * Renders Phraya Phichai Campus Board page
     */
    public function campus() {
        $pdfFile = 'ประกาศแต่งตั้งคณะกรรมการสหวิทยาเขตพระยาพิชัยดาบหัก.pdf';
        $title = __('info_campus') . " | " . SCHOOL_NAME;
        $categoryKey = 'cat_general_admin';
        $pageTitleKey = 'info_campus';
        $description = 'ประกาศการแต่งตั้งคณะกรรมการสหวิทยาเขตพระยาพิชัยดาบหัก เพื่อขับเคลื่อนการบริหารและการจัดการศึกษาของโรงเรียนในกลุ่มวิทยาเขต';
        
        $this->renderPdfView($pdfFile, $title, $categoryKey, $pageTitleKey, $description);
    }

    /**
     * Renders Student Support Handbook page
     */
    public function studentSupportHandbook() {
        $pdfFile = 'คู่มือระบบดูแลช่วยเหลือนักเรียน.pdf';
        $title = __('info_support_handbook') . " | " . SCHOOL_NAME;
        $categoryKey = 'cat_rules_handbook';
        $pageTitleKey = 'info_support_handbook';
        $description = 'คู่มือระบบดูแลช่วยเหลือนักเรียนอย่างเป็นทางการ เพื่อสร้างแนวทางป้องกัน คุ้มครอง และดูแลช่วยเหลือนักเรียนโรงเรียนพิชัย';
        
        $this->renderPdfView($pdfFile, $title, $categoryKey, $pageTitleKey, $description);
    }

    /**
     * Helper to render views wrap
     */
    private function renderPdfView($pdfFile, $title, $categoryKey, $pageTitleKey, $description) {
        // Correctly encode Thai characters in URL path while keeping standard characters intact
        $pdfUrl = UPLOAD_URL . rawurlencode($pdfFile);
        
        // Include layouts and view
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/pdf_viewer.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }
}
