<?php

namespace Biegalski\LaravelMailgunWebhooks\Http\Controllers;

use Illuminate\Http\Request;
use Biegalski\LaravelMailgunWebhooks\Services\MailgunWebookService;

/**
 * Class MailgunWebhooksController
 * @package Biegalski\LaravelMailgunWebhooks\Controllers
 */
class MailgunWebhooksController
{
    /**
     * @var MailgunWebookService
     */
    private $mailgunService;

    /**
     * MailgunWebhooksController constructor.
     * @param MailgunWebookService $mailgunService
     */
    public function __construct(MailgunWebookService $mailgunService)
    {
        $this->mailgunService = $mailgunService;
    }

    /**
     * @param Request $request
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function messageType(Request $request, $type)
    {
        $data = $request->all();

        switch ($type){
            case 'delivered-messages':
                //return print_r($data);
                return $this->processData('Delivered Messages', $data);
            case 'opened-messages':
                return $this->processData('Opened Messages', $data);
            case 'permanent-failure':
                return $this->processData('Permanent Failure', $data);
            case 'spam-complaints':
                return $this->processData('Spam Complaints', $data);
            case 'temporary-failure':
                return $this->processData('Temporary Failure', $data);
            case 'unsubscribes':
                return $this->processData('Unsubscribes', $data);
            default:
                return abort(404);
        }
    }

    /**
     * @param string $type
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function processData(string $type, $data)
    {
        $storeMessageData = $this->mailgunService->store($type, $data);

        if( $storeMessageData ){
            return response()->json('Success!', 200);
        }

        return response()->json('Error!', 503);
    }
}
