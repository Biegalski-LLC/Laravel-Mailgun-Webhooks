<?php

namespace Biegalski\LaravelMailgunWebhooks\Events;

use \Biegalski\LaravelMailgunWebhooks\Model\MailgunEvent;
use Illuminate\Queue\SerializesModels;

class SaveEvent
{
    use SerializesModels;

    public $event;

    public function __construct(MailgunEvent $event)
    {
        $this->event = $event;
    }
}