<?php

return [
    'greeting' => 'salut,',
    'delivered' => [
        'subject' => 'Message délivré',
        'desc' => 'Un courrier électronique a été envoyé avec succès à son destinataire. Les données relatives à cet envoi sont les suivantes:'
    ],
    'opened' => [
        'subject' => 'Message ouvert',
        'desc' => 'Un e-mail a été ouvert avec succès par son destinataire. Les données concernant cette livraison par e-mail sont les suivantes:'
    ],
    'perm_failure' => [
        'subject' => 'Envoi en cas d\'échec permanent',
        'desc' => 'Un e-mail a définitivement échoué à transmettre à son destinataire les données relatives à cette livraison par e-mail ci-dessous:'
    ],
    'spam' => [
        'subject' => 'Rapport de spam',
        'desc' => 'Malheureusement, quelqu\'un a signalé que vos courriels étaient du courrier indésirable, des données concernant cette remise ci-dessous:'
    ],
    'temp_failure' => [
        'subject' => 'Envoi temporaire d\'échec',
        'desc' => 'Un email a temporairement échoué à livrer à son destinataire, les données impliquant cette livraison par email ci-dessous:'
    ],
    'unsubscribe' => [
        'subject' => 'Désabonné',
        'desc' => 'Malheureusement, une personne s\'est désabonnée de votre liste de diffusion, les données concernant cette livraison par courrier électronique sont les suivantes:'
    ],
    'fields' => [
        'recipient' => 'Bénéficiaire',
        'msg' => 'Données du message',
        'msg_to' => 'À',
        'msg_id' => 'ID du message',
        'msg_from' => 'De',
        'msg_subject' => 'Assujettir',
        'tags' => 'Mots clés',
        'variables' => 'Variables'
    ]
];
