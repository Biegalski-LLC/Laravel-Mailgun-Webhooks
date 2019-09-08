<?php

return [
    'greeting' => 'Hi,',
    'delivered' => [
        'subject' => 'Message Delivered',
        'desc' => 'An email was successfully delivered to its recipient, data involving this email delivery below:'
    ],
    'opened' => [
        'subject' => 'Message Opened',
        'desc' => 'An email was successfully opened by its recipient, data involving this email delivery below:'
    ],
    'perm_failure' => [
        'subject' => 'Permanent Failure Sending',
        'desc' => 'An email permanently failed to deliver to its recipient, data involving this email delivery below:'
    ],
    'spam' => [
        'subject' => 'Spam Report',
        'desc' => 'Unfortunately, someone has reported your emails as spam, data involving this email delivery below:'
    ],
    'temp_failure' => [
        'subject' => 'Temporary Failure Sending',
        'desc' => 'An email temporarily failed to deliver to its recipient, data involving this email delivery below:'
    ],
    'unsubscribe' => [
        'subject' => 'Unsubscribed',
        'desc' => 'Unfortunately, someone has unsubscribed from your mailing list, data involving this email delivery below:'
    ],
    'fields' => [
        'recipient' => 'Recipient',
        'msg' => 'Message Data',
        'msg_to' => 'To',
        'msg_id' => 'Message ID',
        'msg_from' => 'From',
        'msg_subject' => 'Subject',
        'tags' => 'Tags',
        'variables' => 'Variables'
    ]
];
