<?php
/*
 * Plugin Name: 1pgWp
 */

require_once 'gravityForms/submission.php';


function gformSubmission($entry, $form) {
    $submission = new Submission();
    return $submission->submission($entry, $form);
}

add_action('gform_after_submission', 'gformSubmission', 10, 2);