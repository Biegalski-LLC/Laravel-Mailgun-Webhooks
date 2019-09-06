<?php

namespace Biegalski\LaravelMailgunWebhooks\Services;

use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunTagRepository;
use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunTypeRepository;
use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunEventRepository;
use Biegalski\LaravelMailgunWebhooks\Repositories\MailgunVariableRepository;

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
     * @var MailgunTagRepository
     */
    private $tag;

    /**
     * @var MailgunTypeRepository
     */
    private $type;

    /**
     * @var MailgunVariableRepository
     */
    private $variable;

    /**
     * MailgunWebookService constructor.
     * @param MailgunEventRepository $event
     * @param MailgunTagRepository $tag
     * @param MailgunTypeRepository $type
     * @param MailgunVariableRepository $variable
     */
    public function __construct(MailgunEventRepository $event, MailgunTagRepository $tag, MailgunTypeRepository $type, MailgunVariableRepository $variable)
    {
        $this->event = $event;
        $this->tag = $tag;
        $this->type = $type;
        $this->variable = $variable;
    }

    /**
     * @param string $type
     * @param array $data
     * @return bool
     */
    public function store(string $type, array $data)
    {
        $eventType = $this->getTypeId($type);

        if( $eventType && isset($eventType->id) && is_int($eventType->id) ){

            $userId = null;

            if( isset($data['recipient']) ){
                $userId = $this->lookupUser($data['recipient']);
            }

            $this->storeEvent($eventType->id, $data, $userId);
        }

        return false;
    }

    /**
     * @param $type
     * @return mixed
     */
    private function getTypeId($type)
    {
        return $this->type->getTypeIdByName($type);
    }

    /**
     * @param int $typeId
     * @param array $data
     * @param null $userId
     * @return mixed
     */
    private function storeEvent(int $typeId, array $data, $userId = null)
    {
        return $this->event->store($typeId, $data, $userId);
    }

    /**
     * @param $emailAddress
     * @return int|null
     */
    private function lookupUser($emailAddress)
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
