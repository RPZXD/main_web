<?php
// controllers/ComplaintsController.php
// Controller for displaying the external complaints Google Form integration

class ComplaintsController {
    /**
     * Renders Complaints Channel page
     */
    public function index() {
        // Fetch URL from configurations (constant loaded by settings_loader.php)
        $complaintsUrl = COMPLAINTS_FORM_URL;
        
        // Define metadata
        $title = __('info_complaints') . " | " . SCHOOL_NAME;
        
        // Include layouts and view
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/complaints.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }
}
