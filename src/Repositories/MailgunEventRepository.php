<?php

namespace Biegalski\LaravelMailgunWebhooks\Repositories;

use App\User;
use Biegalski\LaravelMailgunWebhooks\Model\MailgunEvent;

class MailgunEventRepository
{
    /**
     * @var MailgunEvent
     */
    private $model;

    /**
     * @var User
     */
    private $user;

    /**
     * MailgunEventRepository constructor.
     * @param MailgunEvent $model
     * @param User $user
     */
    public function __construct(MailgunEvent $model, User $user)
    {
        $this->model = $model;
        $this->user = $user;
    }

    /**
     * @param int $eventId
     * @param array $data
     * @param null $userId
     * @return mixed
     */
    public function store(int $eventId, array $data, $userId = null)
    {
        return $this->model->create([
            'event_type_id' => $eventId,
            'uuid' => $data['id'],
            'recipient_domain' => $data['recipient-domain'],
            'recipient_user' => $data['recipient'],
            'msg_to' => $data['headers']['to'] ?? null,
            'msg_from' => $data['headers']['from'] ?? null,
            'msg_subject' => $data['headers']['subject'] ?? null,
            'msg_id' => $data['headers']['message-id'] ?? null,
            'msg_code' => $data['delivery-status']['code'] ?? null,
            'attempt_number' => $data['delivery-status']['attempt-no'],
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
        return $this->user->where('email', $email)->first();
    }
}
