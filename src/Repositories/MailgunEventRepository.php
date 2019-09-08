<?php

namespace Biegalski\LaravelMailgunWebhooks\Repositories;

use Illuminate\Support\Facades\DB;
use Biegalski\LaravelMailgunWebhooks\Model\MailgunEvent;
use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunTagRepository;
use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunFlagRepository;
use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunVariableRepository;

/**
 * Class MailgunEventRepository
 * @package Biegalski\LaravelMailgunWebhooks\Repositories
 */
class MailgunEventRepository
{
    /**
     * @var DB
     * @desc Use DB Facade for user table since it may vary system to system
     */
    private $dbquery;

    /**
     * @var \Biegalski\LaravelMailgunWebhooks\Repositories\MailgunFlagRepository
     */
    private $flags;

    /**
     * @var MailgunEvent
     */
    private $model;

    /**
     * @var \Biegalski\LaravelMailgunWebhooks\Repositories\MailgunTagRepository
     */
    private $tag;

    /**
     * @var \Biegalski\LaravelMailgunWebhooks\Repositories\MailgunVariableRepository
     */
    private $variable;

    /**
     * MailgunEventRepository constructor.
     * @param MailgunEvent $model
     * @param DB $dbquery
     * @param \Biegalski\LaravelMailgunWebhooks\Repositories\MailgunTagRepository $tag
     * @param \Biegalski\LaravelMailgunWebhooks\Repositories\MailgunVariableRepository $variable
     */
    public function __construct(MailgunEvent $model, DB $dbquery, MailgunFlagRepository $flags, MailgunTagRepository $tag, MailgunVariableRepository $variable)
    {
        $this->model = $model;
        $this->dbquery = $dbquery;
        $this->flags = $flags;
        $this->tag = $tag;
        $this->variable = $variable;
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

        if( !empty($data['event-data']['flags']) && is_array($data['event-data']['flags']) ){
            $this->flags->createFlags($data['event-data']['flags'], $storeEvent->id);
        }

        if( !empty($data['event-data']['tags']) && is_array($data['event-data']['tags']) ){
            $this->tag->tagEvent($data['event-data']['tags'], $storeEvent->id);
        }

        if( !empty($data['event-data']['user-variables']) && is_array($data['event-data']['user-variables']) ){
            $this->variable->processEventVariables($data['event-data']['user-variables'], $storeEvent->id);
        }

        return true;
    }

    /**
     * @param string $eventType
     * @param array $data
     * @param null $userId
     * @return mixed
     */
    private function storeEvent(string $eventType, array $data, $userId = null)
    {
        return $this->model->create([
            'event_type' => $eventType,
            'uuid' => $data['event-data']['id'],
            'recipient_domain' => $data['event-data']['recipient-domain'] ?? null,
            'recipient_user' => $data['event-data']['recipient'] ?? null,
            'msg_to' => $this->getHeaders('to', $data),
            'msg_from' => $this->getHeaders('from', $data),
            'msg_subject' => $this->getHeaders('subject', $data),
            'msg_id' => $this->getHeaders('msg_id', $data),
            'msg_code' => $data['event-data']['delivery-status']['code'] ?? null,
            'attempt_number' => $data['event-data']['delivery-status']['attempt-no'] ?? 1,
            'attachments' => $this->areAttachmentsIncluded($data),
            'user_id' => $userId,
        ]);
    }

    /**
     * @param string $type
     * @param array $data
     * @return mixed|null
     */
    private function getHeaders(string $type, array $data)
    {
        if( isset($data['event-data']['message']['headers']) && is_array($data['event-data']['message']['headers']) ){
            switch ($type){
                case 'to':
                    return $data['event-data']['message']['headers']['to'] ?? null;
                case 'from':
                    return $data['event-data']['message']['headers']['from'] ?? null;
                case 'subject':
                    return $data['event-data']['message']['headers']['subject'] ?? null;
                case 'msg_id':
                    return $data['event-data']['message']['headers']['message-id'] ?? null;
                default:
                    return null;
            }
        }

        return null;
    }

    /**
     * @param array $data
     * @return int
     */
    private function areAttachmentsIncluded(array $data)
    {
        if( isset($data['event-data']['message']['attachments']) && empty($data['event-data']['message']['attachments']) ){
            return 0;
        }

        return 1;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function findUser(string $email)
    {
        return $this->dbquery::table( config('mailgun-webhooks.user_table.name') )
            ->where( config('mailgun-webhooks.user_table.email_column'), $email)
            ->first();
    }
}
