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
     * @var \GuzzleHttp\Client
     */
    private $guzzle;

    /**
     * @desc Default user lookup to null
     *
     * @var null
     */
    private $user = null;

    /**
     * @var array
     */
    private $saveContentEventTypes = [
        'Delivered Messages',
        'Permanent Failure',
        'Temporary Failure'
    ];

    /**
     * MailgunWebookService constructor.
     * @param MailgunEventRepository $event
     */
    public function __construct(MailgunEventRepository $event)
    {
        $this->event = $event;
        $this->guzzle = new \GuzzleHttp\Client();
    }

    /**
     * @param string $eventType
     * @param array $data
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(string $eventType, array $data): ?bool
    {
        if( isset($data['event-data']['recipient']) ){
            $this->user = $this->lookupUser($data['event-data']['recipient']);
        }

        try{
            $eventId = $this->storeEvent($eventType, $data, $this->user);

            /**
             * @desc If event type is Delivered Messages and eventId integer is returned and Mailgun contains storage URL - lets store that messages content
             */
            if( is_int($eventId) && isset($data['event-data']['storage']['url']) && in_array($eventType, $this->saveContentEventTypes, true) ){
                $this->storeContent($eventId, $data['event-data']['storage']['url']);
            }

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
     * @param int $eventId
     * @param string $storageUrl
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function storeContent(int $eventId, string $storageUrl)
    {
        $getContent = $this->guzzle->request(
            'GET',
            $storageUrl,
            [
                'auth' => [
                    'api',
                    config('services.mailgun.secret')
                ]
            ]
        );

        return $this->event->storeContent(
            $eventId,
            json_decode( $getContent->getBody()->getContents(), true )
        );
    }

    /**
     * @param $emailAddress
     * @return int|null
     */
    private function lookupUser($emailAddress): ?int
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
