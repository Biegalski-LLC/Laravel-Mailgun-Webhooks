<?php

namespace Biegalski\LaravelMailgunWebhooks\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailgunEventTag
 * @package Biegalski\LaravelMailgunWebhooks\Model
 */
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
