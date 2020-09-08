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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MailgunEvent::class, 'event_id');
    }
}
