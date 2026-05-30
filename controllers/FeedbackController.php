<?php
// controllers/FeedbackController.php
// Controller for displaying the external feedback Google Form integration

class FeedbackController {
    /**
     * Renders Feedback Channel page
     */
    public function index() {
        // Fetch URL from configurations (constant loaded by settings_loader.php)
        $feedbackUrl = FEEDBACK_FORM_URL;
        
        // Define metadata
        $title = __('info_feedback') . " | " . SCHOOL_NAME;
        
        // Include layouts and view
        require ROOT_PATH . 'views/layouts/header.php';
        require ROOT_PATH . 'views/frontend/feedback.php';
        require ROOT_PATH . 'views/layouts/footer.php';
    }
}
