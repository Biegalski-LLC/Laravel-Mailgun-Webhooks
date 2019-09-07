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
                return $this->deliveredMessages($data);
            case 'opened-messages':
                return $this->openedMessages($data);
            default:
                return abort(404);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function deliveredMessages($data) : \Illuminate\Http\JsonResponse
    {
        return $this->processData('Delivered Messages', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function openedMessages($data) : \Illuminate\Http\JsonResponse
    {
        return $this->processData('Opens', $data);
    }

    /**
     * @param string $type
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function processData(string $type, $data)
    {
        $storeDeliveredMessage = $this->mailgunService->store($type, $data);

        if( $storeDeliveredMessage ){
            return response()->json('Success!', 200);
        }

        return response()->json('Error!', 503);
    }
}
