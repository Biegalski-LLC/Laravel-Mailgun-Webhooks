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
}
