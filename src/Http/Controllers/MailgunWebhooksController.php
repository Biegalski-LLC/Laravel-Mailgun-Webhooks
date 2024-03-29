<?php

namespace Biegalski\LaravelMailgunWebhooks\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Biegalski\LaravelMailgunWebhooks\Services\MailgunAlertService;
use Biegalski\LaravelMailgunWebhooks\Services\MailgunWebookService;

/**
 * Class MailgunWebhooksController
 * @package Biegalski\LaravelMailgunWebhooks\Controllers
 */
class MailgunWebhooksController extends Controller
{
    /**
     * @var MailgunAlertService
     */
    private $alertService;

    /**
     * @var MailgunWebookService
     */
    private $mailgunService;

    /**
     * MailgunWebhooksController constructor.
     * @param MailgunAlertService $alertService
     * @param MailgunWebookService $mailgunService
     */
    public function __construct(MailgunAlertService $alertService, MailgunWebookService $mailgunService)
    {
        $this->alertService = $alertService;
        $this->mailgunService = $mailgunService;
    }

    /**
     * @param Request $request
     * @param $type
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function messageType(Request $request, $type)
    {
        $data = $request->all();

        switch ($type){
            case 'clicked':
                return $this->processData('Clicks', $data);
            case 'delivered':
                return $this->processData('Delivered Messages', $data);
            case 'opened':
                return $this->processData('Opened Messages', $data);
            case 'perm-failure':
                return $this->processData('Permanent Failure', $data);
            case 'spam':
                return $this->processData('Spam Complaints', $data);
            case 'temp-failure':
                return $this->processData('Temporary Failure', $data);
            case 'unsubscribe':
                return $this->processData('Unsubscribes', $data);
            default:
                return abort(404);
        }
    }

    /**
     * @param string $type
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function processData(string $type, $data)
    {
        $storeMessageData = $this->mailgunService->store($type, $data);

        if (config('mailgun-webhooks.send_alerts')) {
            try {
                $this->alertService->sendAlert($type, $data);
            } catch (\Exception $exception){
                return response()->json('Error: ' . $exception->getMessage(), 503);
            }
        }

        if ($storeMessageData ) {
            return response()->json('Success!', 200);
        }

        return response()->json('Error!', 503);
    }
}
