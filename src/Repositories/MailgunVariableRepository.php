<?php

namespace Biegalski\LaravelMailgunWebhooks\Repositories;

use Biegalski\LaravelMailgunWebhooks\Model\MailgunVariable;

/**
 * Class MailgunVariableRepository
 * @package Biegalski\LaravelMailgunWebhooks\Repositories
 */
class MailgunVariableRepository
{
    /**
     * @var MailgunVariable
     */
    private $model;

    /**
     * MailgunVariableRepository constructor.
     * @param MailgunVariable $model
     */
    public function __construct(MailgunVariable $model)
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
    public function processEventVariables(array $data, int $eventId)
    {
        foreach ($data as $key => $value){
            if( isset($key, $value) ){
                $this->createVariables($eventId, $key, $value);
            }
        }

        return true;
    }

    /**
     * @param int $eventId
     * @param string $key
     * @param string $value
     * @return mixed
     */
    private function createVariables(int $eventId, string $key, string $value)
    {
        return $this->model->create([
            'event_id' => $eventId,
            'key' => $key,
            'value' => $value
        ]);
    }
}
