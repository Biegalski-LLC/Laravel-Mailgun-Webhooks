<?php

namespace Biegalski\LaravelMailgunWebhooks\Services;

use Illuminate\Support\Facades\Log;
use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunEventRepository;

/**
 * Class MailgunWebookService
 * @package Biegalski\LaravelMailgunWebhooks\Services
 */
class MailgunWebookService
{
    /**
     * @var MailgunEventRepository
     */
    private $event;

    /**
     * @desc Default user lookup to null
     *
     * @var null
     */
    private $user = null;

    /**
     * MailgunWebookService constructor.
     * @param MailgunEventRepository $event
     */
    public function __construct(MailgunEventRepository $event)
    {
        $this->event = $event;
    }

    /**
     * @param string $eventType
     * @param array $data
     * @return bool
     */
    public function store(string $eventType, array $data)
    {
        if( isset($data['event-data']['recipient']) ){
            $this->user = $this->lookupUser($data['event-data']['recipient']);
        }

        try{
            $this->storeEvent($eventType, $data, $this->user);

            return true;
        }catch (\Exception $exception){

            Log::error($exception->getMessage());

            return false;
        }
    }

    /**
     * @param string $eventType
     * @param array $data
     * @param null $userId
     * @return mixed
     */
    private function storeEvent(string $eventType, array $data, $userId = null)
    {
        return $this->event->store($eventType, $data, $userId);
    }

    /**
     * @param $emailAddress
     * @return int|null
     */
    private function lookupUser($emailAddress) : ?int
    {
        if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            $findUser = $this->event->findUser($emailAddress);

            if( $findUser && isset( $findUser->id) && is_int($findUser->id) ){
                return $findUser->id;
            }
        }

        return null;
    }
}
