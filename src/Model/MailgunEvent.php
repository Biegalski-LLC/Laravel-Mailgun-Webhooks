<?php

namespace Biegalski\LaravelMailgunWebhooks\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailgunEvent
 * @package Biegalski\LaravelMailgunWebhooks\Model
 */
class MailgunEvent extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attachments' => 'boolean'
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => \Biegalski\LaravelMailgunWebhooks\Events\CreatedEvent::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_type',
        'user_id',
        'uuid',
        'recipient_domain',
        'recipient_user',
        'msg_to',
        'msg_from',
        'msg_subject',
        'msg_id',
        'msg_code',
        'attempt_number',
        'attachments'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('mailgun-webhooks.users_table.model_fpqn'), 'user_id', config('mailgun-webhooks.users_table.identifier_key'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function content(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MailgunEventContent::class, 'event_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flags(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MailgunFlag::class, 'event_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(MailgunTag::class, MailgunEventTag::class, 'event_id', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variables(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MailgunVariable::class, 'event_id', 'id');
    }
}
