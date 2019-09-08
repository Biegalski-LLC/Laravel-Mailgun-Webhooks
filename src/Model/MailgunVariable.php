<?php

namespace Biegalski\LaravelMailgunWebhooks\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailgunVariable
 * @package Biegalski\LaravelMailgunWebhooks\Model
 */
class MailgunVariable extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'event_id',
        'key',
        'value'
    ];
}
