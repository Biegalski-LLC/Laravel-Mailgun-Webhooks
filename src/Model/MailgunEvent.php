<?php

namespace Biegalski\LaravelMailgunWebhooks\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MailgunEvent
 * @package Biegalski\LaravelMailgunWebhooks\Model
 */
class MailgunEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_type_id',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attachments' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(MailgunType::class, 'event_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(MailgunTag::class, MailgunEventTag::class, 'event_id', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variables()
    {
        return $this->hasMany(MailgunVariable::class, 'event_id', 'id');
    }
}
