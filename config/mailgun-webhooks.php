<?php

return [
    'user_table' => [
        'name' => env('MAILGUN_WEBHOOKS_USER_TABLE_NAME', 'users'),
        'email_column' => env('MAILGUN_WEBHOOKS_USER_TABLE_EMAIL', 'email'),
        'identifier_key' => env('MAILGUN_WEBHOOKS_USER_TABLE_KEY', 'id'),
        'model_fpqn' => env('MAILGUN_WEBHOOKS_USER_TABLE_KEY', 'id')
    ],
    'trigger_alerts' => [
        'delivered' => env('MAILGUN_WEBHOOKS_TRIGGER_DELIVERED', false),
        'opened' => env('MAILGUN_WEBHOOKS_TRIGGER_OPENED', false),
        'perm_failure' => env('MAILGUN_WEBHOOKS_TRIGGER_PERM_FAILURE', false),
        'spam' => env('MAILGUN_WEBHOOKS_TRIGGER_SPAM', false),
        'temp_failure' => env('MAILGUN_WEBHOOKS_TRIGGER_TEMP_FAILURE', false),
        'unsubscribe' => env('MAILGUN_WEBHOOKS_TRIGGER_UNSUBSCRIBE', false),
    ],
    'send_alerts' => [
        'to' => env('MAILGUN_WEBHOOKS_ALERTS_TO', null),
        'subject' => env('MAILGUN_WEBHOOKS_ALERTS_SUBJECT_PREFIX', 'Mailgun Trigger:')
    ],
    'event_types' => [
        'Delivered Messages',
        'Opened Messages',
        'Permanent Failure',
        'Spam Complaints',
        'Temporary Failure',
        'Unsubscribes'
    ]
];
