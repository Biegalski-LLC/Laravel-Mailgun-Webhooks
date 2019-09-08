<?php

return [
    'greeting' => 'Hallo,',
    'delivered' => [
        'subject' => 'Nachricht zugestellt',
        'desc' => 'Eine E-Mail wurde erfolgreich an den Empfänger gesendet. Die Daten für diese E-Mail-Zustellung sind nachfolgend aufgeführt:'
    ],
    'opened' => [
        'subject' => 'Nachricht geöffnet',
        'desc' => 'Eine E-Mail wurde vom Empfänger erfolgreich geöffnet. Die Daten für diese E-Mail-Zustellung sind nachstehend aufgeführt:'
    ],
    'perm_failure' => [
        'subject' => 'Dauerhafter Fehler beim Senden',
        'desc' => 'Eine E-Mail konnte dauerhaft nicht an den Empfänger gesendet werden. Die Daten für diese E-Mail-Zustellung lauten wie folgt:'
    ],
    'spam' => [
        'subject' => 'Spam-Bericht',
        'desc' => 'Leider hat jemand Ihre E-Mails als Spam gemeldet. Die Daten für diese E-Mail-Zustellung sind nachfolgend aufgeführt:'
    ],
    'temp_failure' => [
        'subject' => 'Vorübergehender Fehler beim Senden',
        'desc' => 'Eine E-Mail konnte vorübergehend nicht an den Empfänger gesendet werden. Die Daten für diese E-Mail-Zustellung lauten wie folgt:'
    ],
    'unsubscribe' => [
        'subject' => 'Abgemeldet',
        'desc' => 'Leider hat sich jemand von Ihrer Mailingliste abgemeldet. Die Daten für diese E-Mail-Zustellung sind unten aufgeführt:'
    ],
    'fields' => [
        'recipient' => 'Empfänger',
        'msg' => 'Nachrichtendaten',
        'msg_to' => 'Zu',
        'msg_id' => 'Nachrichten ID',
        'msg_from' => 'Von',
        'msg_subject' => 'Gegenstand',
        'tags' => 'Stichworte',
        'variables' => 'Variablen'
    ]
];
