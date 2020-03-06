<?php

namespace Biegalski\LaravelMailgunWebhooks\Events;

use Biegalski\LaravelMailgunWebhooks\Model\MailgunEvent;
use Illuminate\Queue\SerializesModels;

class SaveEvent
{
    use SerializesModels;

    public $event;

    /**
     * Create a new event instance.
     *
     * @param \Biegalski\LaravelMailgunWebhooks\Model\MailgunEvent $event
     */
    public function __construct(MailgunEvent $event)
    {
        $this->event = $event;
    }
}