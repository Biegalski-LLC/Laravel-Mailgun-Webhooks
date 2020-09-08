<?php

namespace Biegalski\LaravelMailgunWebhooks\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailgunFlag
 * @package App
 */
class MailgunFlag extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_routed' => 'boolean',
        'is_authenticated' => 'boolean',
        'is_system_test' => 'boolean',
        'is_test_mode' => 'boolean'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'event_id',
        'is_routed',
        'is_authenticated',
        'is_system_test',
        'is_test_mode'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MailgunEvent::class, 'event_id');
    }
}
