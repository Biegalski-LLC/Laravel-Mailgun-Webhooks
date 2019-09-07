<?php

namespace Biegalski\LaravelMailgunWebhooks\Repositories;

use Illuminate\Support\Facades\DB;
use Biegalski\LaravelMailgunWebhooks\Model\MailgunEvent;
use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunTagRepository;

class MailgunEventRepository
{
    /**
     * @var DB
     * @desc Use DB Facade for user table since it may vary system to system
     */
    private $dbquery;

    /**
     * @var MailgunEvent
     */
    private $model;

    /**
     * @var \Biegalski\LaravelMailgunWebhooks\Repositories\MailgunTagRepository
     */
    private $tag;

    /**
     * MailgunEventRepository constructor.
     * @param MailgunEvent $model
     * @param DB $dbquery
     * @param \Biegalski\LaravelMailgunWebhooks\Repositories\MailgunTagRepository $tag
     */
    public function __construct(MailgunEvent $model, DB $dbquery, MailgunTagRepository $tag)
    {
        $this->model = $model;
        $this->dbquery = $dbquery;
        $this->tag = $tag;
    }

    /**
     * @param string $eventType
     * @param array $data
     * @param null $userId
     * @return mixed
     */
    public function store(string $eventType, array $data, $userId = null)
    {
        $storeEvent = $this->storeEvent($eventType, $data, $userId);

        if( !empty($data['event-data']['tags']) && is_array($data['event-data']['tags']) ){
            $this->tag->tagEvent($data['event-data']['tags'], $storeEvent->id);
        }

        return true;
    }

    private function storeEvent(string $eventType, array $data, $userId = null)
    {
        return $this->model->create([
            'event_type' => $eventType,
            'uuid' => $data['event-data']['id'],
            'recipient_domain' => $data['event-data']['recipient-domain'],
            'recipient_user' => $data['event-data']['recipient'],
            'msg_to' => $data['event-data']['headers']['to'] ?? null,
            'msg_from' => $data['event-data']['headers']['from'] ?? null,
            'msg_subject' => $data['event-data']['headers']['subject'] ?? null,
            'msg_id' => $data['event-data']['headers']['message-id'] ?? null,
            'msg_code' => $data['event-data']['delivery-status']['code'] ?? null,
            'attempt_number' => $data['event-data']['delivery-status']['attempt-no'],
            'attachments' => 0,
            'user_id' => $userId,
        ]);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function findUser(string $email)
    {
        return $this->dbquery
            ->table( config('mailgun-webhooks.user_table.name') )
            ->where( config('mailgun-webhooks.user_table.email_column'), $email)
            ->first();
    }
}
