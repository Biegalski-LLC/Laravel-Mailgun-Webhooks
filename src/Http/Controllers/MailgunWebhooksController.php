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
     * @return bool
     */
    public function deliveredMessages(Request $request)
    {
        $storeDeliveredMessage = $this->mailgunService->store('Delivered Messages', $request->all());

        if( $storeDeliveredMessage ){
            return response()->json('Success!', 200);
        }

        return response()->json('Error!', 503);
    }
}
