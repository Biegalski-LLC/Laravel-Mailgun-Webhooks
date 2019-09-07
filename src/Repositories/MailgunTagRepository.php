<?php

namespace Biegalski\LaravelMailgunWebhooks\Repositories;

use Biegalski\LaravelMailgunWebhooks\Model\MailgunTag;
use Biegalski\LaravelMailgunWebhooks\Model\MailgunEventTag;

class MailgunTagRepository
{
    /**
     * @var MailgunTag
     */
    private $model;

    /**
     * @var MailgunEventTag
     */
    private $eventTag;

    /**
     * MailgunTagRepository constructor.
     * @param MailgunTag $model
     * @param DB $dbquery
     */
    public function __construct(MailgunTag $model, MailgunEventTag $eventTag)
    {
        $this->model = $model;
        $this->eventTag = $eventTag;
    }

    /**
     * @param string $tag
     * @return mixed
     */
    public function findOrCreateTag(string $tag)
    {
        return $this->model->firstOrCreate(['tag_name' => $tag]);
    }

    /**
     * @param array $tags
     * @param int $eventId
     */
    public function tagEvent(array $tags, int $eventId)
    {
        foreach ($tags as $tag){
            $findTag = $this->findOrCreateTag($tag);

            if( isset($findTag->id) ){
                $this->eventTag->create([
                        'event_id' => $eventId,
                        'tag_id' => $findTag->id
                    ]);
            }
        }
    }

}
