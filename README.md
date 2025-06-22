# SureForm to Newsletter Sync Plugin

A WordPress plugin that automatically adds SureForm users to Newsletter plugin subscriber list.

## Description

This plugin creates an integration between SureForm submissions and the Newsletter plugin. When a user submits a form through SureForm, their email address is automatically added to your Newsletter plugin subscribers list.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/sureform-to-newsletter-sync` directory
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Configure the allowed form IDs in the plugin file

## Configuration

Edit the `$allowed_form_ids` array in the plugin file to include the form IDs you want to sync with Newsletter:

```php
$allowed_form_ids = array('xx'); // Replace with your actual form ID(s)
```

## How it Works
When a form is submitted in SureForm, this plugin checks if the form ID matches your configured list
- If the form matches, it extracts the email address from the submission
- It validates the email and checks if the user already exists in Newsletter
- If the email is new, it adds the user to Newsletter with "Confirmed" status (C)
