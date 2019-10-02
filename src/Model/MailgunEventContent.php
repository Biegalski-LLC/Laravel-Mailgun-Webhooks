<?php

namespace Biegalski\LaravelMailgunWebhooks\Model;

use Illuminate\Database\Eloquent\Model;

class MailgunEventContent extends Model
{
    /**
     * @var string
     */
    protected $table = 'mailgun_event_content';

    /**
     * @var array
     */
    protected $fillable = [
        'event_id',
        'subject',
        'to',
        'content_type',
        'message_id',
        'stripped_text',
        'stripped_html',
        'body_html',
        'body_plain'
    ];
}
