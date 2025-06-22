<?php
/**
 * Plugin Name: SureForm to Newsletter Sync
 * Description: Automatically adds SureForm users to Newsletter plugin subscriber list.
 * Version: 1.0
 * Author: Zeel
 */

if (!defined('ABSPATH')) exit;

add_action('srfm_form_submit', 'sf_newsletter_sync_on_submit', 10, 1);

function sf_newsletter_sync_on_submit($submission) {
    $target_form_id = $submission["form_id"];

    $allowed_form_ids = array('xxx'); # Just add your form IDs here.

    if (!in_array($target_form_id, $allowed_form_ids)) {
        return;
    }
    
    if (!isset($submission['to_emails'])) return;
    
    $email = sanitize_email($submission['to_emails'][0]);
    
    if (!class_exists('NewsletterSubscription')) return;

    if (!class_exists('Newsletter')) return;
    
    $newsletter = Newsletter::instance();
    $subscription = NewsletterSubscription::instance();
    
    $user_data = [
        'email' => $email,
        'status' => 'C',
        'list' => [1]
    ];
    $email = $newsletter->normalize_email(stripslashes($email));

    if (!$email) {
        return new WP_Error('-1', 'Email address not valid', array('status' => 400));
    }

    $user = $newsletter->get_user($email);

    if ($user) {
        return;
    }

    $user = array('email' => $email);

    $user['status'] = 'C';

    $user['ip'] = Newsletter::get_remote_ip();

    $user = $newsletter->save_user($user);
}
