<?php

namespace Biegalski\LaravelMailgunWebhooks\Database\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Biegalski\LaravelMailgunWebhooks\Model\MailgunEvent;

class MailgunEventTypesTableSeeder extends Seeder
{
    /**
     * @var array
     */
    private $types = array(
        'Delivered Messages',
        'Opens',
        'Permanent Failure',
        'Spam Complaints',
        'Temporary Failure',
        'Unsubscribes'
    );

    /**
     * @param $types
     * @return array
     */
    private function buildArray($types)
    {
        $typeArray = array();

        foreach ($types as $type){
            $typeArray = array(
                'event_type' => $type,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            );
        }

        return $typeArray;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailgunEvent::insert( $this->buildArray( $this->types ) );
    }
}
