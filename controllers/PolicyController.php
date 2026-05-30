<?php
// controllers/PolicyController.php
// Controller for displaying school policy pages (No Gift Policy and Do's & Don'ts)

class PolicyController {
    /**
     * Renders No Gift Policy Page
     */
    public function noGift() {
        $pdfFile = "ประกาศเจตนารมณ์ นโยบาย No Gift Polioy จากการปฏิบัติหน้าที่.pdf";
        $pdfUrl = UPLOAD_URL . rawurlencode($pdfFile);
        
        $localFilePath = UPLOAD_DIR . $pdfFile;
        $fileExists = file_exists($localFilePath);

        $title = __('info_no_gift') . " | " . SCHOOL_NAME;
        
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/no_gift.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }

    /**
     * Renders Do's & Don'ts Guidelines Page
     */
    public function dosDonts() {
        $pdfFile = "แนวปฏิบัติ DO'S & Don'ts.pdf";
        $pdfUrl = UPLOAD_URL . rawurlencode($pdfFile);
        
        $localFilePath = UPLOAD_DIR . $pdfFile;
        $fileExists = file_exists($localFilePath);
        
        $title = __('info_dos_donts') . " | " . SCHOOL_NAME;
        
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/dos_donts.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }
}
