<?php

namespace Biegalski\LaravelMailgunWebhooks\Model;

use Illuminate\Database\Eloquent\Model;

class MailgunEventTag extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'event_id',
        'tag_id'
    ];
}
