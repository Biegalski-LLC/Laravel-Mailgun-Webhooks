<?php

namespace Biegalski\LaravelMailgunWebhooks\Model;

use Illuminate\Database\Eloquent\Model;

class MailgunTag extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['tag_name'];
}
