<?php

namespace Biegalski\LaravelMailgunWebhooks\Repositories;

use Biegalski\LaravelMailgunWebhooks\Model\MailgunFlag;

/**
 * Class MailgunFlagRepository
 * @package Biegalski\LaravelMailgunWebhooks\Repositories
 */
class MailgunFlagRepository
{
    /**
     * @var MailgunFlag
     */
    private $model;

    /**
     * MailgunFlagRepository constructor.
     * @param MailgunFlag $model
     */
    public function __construct(MailgunFlag $model)
    {
        $this->model = $model;

        if( config()->has('mailgun-webhooks.custom_database') && config('mailgun-webhooks.custom_database') !== null ){
            $this->model->setConnection(config('mailgun-webhooks.custom_database'));
        }
    }

    /**
     * @param array $data
     * @param int $eventId
     * @return mixed
     */
    public function createFlags(array $data, int $eventId)
    {
        return $this->model->create([
            'event_id' => $eventId,
            'is_routed' => $data['is-routed'] ?? 0,
            'is_authenticated' => $data['is-authenticated'] ?? 0,
            'is_system_test' => $data['is-system_test'] ?? 0,
            'is_test_mode' => $data['is-test_mode'] ?? 0
        ]);
    }
}
