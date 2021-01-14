<?php

return [
    'content_logging' => [
        'stripped_text' => env('MAILGUN_WEBHOOKS_CONTENT_LOG_STRIP_TEXT', false),
        'stripped_html' => env('MAILGUN_WEBHOOKS_CONTENT_LOG_STRIP_HTML', false),
        'body_html' => env('MAILGUN_WEBHOOKS_CONTENT_LOG_BODY_HTML', true),
        'body_plain' => env('MAILGUN_WEBHOOKS_CONTENT_LOG_BODY_PLAIN', false),
    ],
    'custom_database' => env('MAILGUN_WEBHOOKS_CUSTOM_DATABASE', null),
    'event_types' => [
        'Clicks',
        'Delivered Messages',
        'Opened Messages',
        'Permanent Failure',
        'Spam Complaints',
        'Temporary Failure',
        'Unsubscribes'
    ],
    'options' => [
        'disable_content_logging' => env('MAILGUN_WEBHOOKS_OPTIONS_DISABLE_CONTENT', false),
        'disable_flag_logging' => env('MAILGUN_WEBHOOKS_OPTIONS_DISABLE_FLAG', false),
        'disable_tag_logging' => env('MAILGUN_WEBHOOKS_OPTIONS_DISABLE_TAG', false),
        'disable_variable_logging' => env('MAILGUN_WEBHOOKS_OPTIONS_DISABLE_VARIABLE', false),
    ],
    'send_alerts' => [
        'to' => env('MAILGUN_WEBHOOKS_ALERTS_TO', null),
        'from_email' => env('MAILGUN_WEBHOOKS_ALERTS_FROM_EMAIL', null),
        'from_name' => env('MAILGUN_WEBHOOKS_ALERTS_FROM_NAME', null),
        'subject_prefix' => env('MAILGUN_WEBHOOKS_ALERTS_SUBJECT_PREFIX', 'Mailgun Trigger:')
    ],
    'trigger_alerts' => [
        'delivered' => env('MAILGUN_WEBHOOKS_TRIGGER_DELIVERED', false),
        'opened' => env('MAILGUN_WEBHOOKS_TRIGGER_OPENED', false),
        'perm_failure' => env('MAILGUN_WEBHOOKS_TRIGGER_PERM_FAILURE', false),
        'spam' => env('MAILGUN_WEBHOOKS_TRIGGER_SPAM', false),
        'temp_failure' => env('MAILGUN_WEBHOOKS_TRIGGER_TEMP_FAILURE', false),
        'unsubscribe' => env('MAILGUN_WEBHOOKS_TRIGGER_UNSUBSCRIBE', false),
    ],
    'user_table' => [
        'name' => env('MAILGUN_WEBHOOKS_USER_TABLE_NAME', 'users'),
        'email_column' => env('MAILGUN_WEBHOOKS_USER_TABLE_EMAIL', 'email'),
        'identifier_key' => env('MAILGUN_WEBHOOKS_USER_TABLE_KEY', 'id'),
        'model_fpqn' => env('MAILGUN_WEBHOOKS_USER_TABLE_FPQN', 'App\User')
    ],
    'signing_key' => env('MAILGUN_WEBHOOKS_SIGNING_KEY', null),
];
