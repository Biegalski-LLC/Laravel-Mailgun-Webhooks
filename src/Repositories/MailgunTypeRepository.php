<?php

namespace Biegalski\LaravelMailgunWebhooks\Repositories;

use Biegalski\LaravelMailgunWebhooks\Model\MailgunType;

class MailgunTypeRepository
{
    /**
     * @var MailgunType
     */
    private $model;

    /**
     * MailgunTypeRepository constructor.
     * @param MailgunType $model
     */
    public function __construct(MailgunType $model)
    {
        $this->model = $model;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getTypeIdByName($name)
    {
        return $this->model->where('event_type', $name)->first();
    }

}
