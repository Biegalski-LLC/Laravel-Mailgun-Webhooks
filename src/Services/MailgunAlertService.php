<?php

namespace Biegalski\LaravelMailgunWebhooks\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class MailgunAlertService
 * @package Biegalski\LaravelMailgunWebhooks\Services
 */
class MailgunAlertService
{
    /**
     * MailgunAlertService constructor.
     * @param Mail $mail
     */
    public function __construct()
    {
        //
    }

    /**
     * @param string $type
     * @param $data
     * @return bool|null
     */
    public function sendAlert(string $type, $data)
    {
        switch ($type){
            case 'Delivered Messages':
                if( config('mailgun-webhooks.trigger_alerts.delivered') === true ){

                    $data = $this->addTranslatedSubjectDesc('delivered', $data);

                    return $this->sendEmail($type, $data);
                }
                break;
            case 'Opened Messages':
                if( config('mailgun-webhooks.trigger_alerts.opened') === true ){

                    $data = $this->addTranslatedSubjectDesc('opened', $data);

                    return $this->sendEmail($type, $data);
                }
                break;
            case 'Permanent Failure':
                if( config('mailgun-webhooks.trigger_alerts.perm_failure') === true ){

                    $data = $this->addTranslatedSubjectDesc('perm_failure', $data);

                    return $this->sendEmail($type, $data);
                }
                break;
            case 'Spam Complaints':
                if( config('mailgun-webhooks.trigger_alerts.spam') === true ){

                    $data = $this->addTranslatedSubjectDesc('spam', $data);

                    return $this->sendEmail($type, $data);
                }
                break;
            case 'Temporary Failure':
                if( config('mailgun-webhooks.trigger_alerts.temp_failure') === true ){

                    $data = $this->addTranslatedSubjectDesc('temp_failure', $data);

                    return $this->sendEmail($type, $data);
                }
                break;
            case 'Unsubscribes':
                if( config('mailgun-webhooks.trigger_alerts.unsubscribe') === true ){

                    $data = $this->addTranslatedSubjectDesc('unsubscribe', $data);

                    return $this->sendEmail($type, $data);
                }
                break;
            default:
                return null;
        }
    }

    /**
     * @param string $type
     * @param array $data
     * @return array
     */
    private function addTranslatedSubjectDesc(string $type, array $data)
    {
        $data['alert_email_subject'] = trans('laravel-mailgun-webhooks::email.' . $type . '.subject');
        $data['alert_email_desc'] = trans('laravel-mailgun-webhooks::email.' . $type . '.desc');

        return $data;
    }

    /**
     * @param string $eventType
     * @param array $data
     * @return bool
     */
    private function sendEmail(string $eventType, array $data)
    {
        $subject = $this->buildEmailSubject($eventType);

        try{
            Mail::send('emails.mailgun_alert', ['data' => $data], function($m) use ($eventType, $subject) {
                $m->from( config('mailgun-webhooks.send_alerts.from_email'), config('mailgun-webhooks.send_alerts.from_name') )
                    ->to( config('mailgun-webhooks.send_alerts.to') )
                    ->subject($subject);
            });
            return true;
        }catch (\Exception $exception){

            Log::error($exception->getMessage());

            return false;
        }
    }

    /**
     * @param string $eventType
     * @return string
     */
    private function buildEmailSubject(string $eventType)
    {
        return config('mailgun-webhooks.send_alerts.subject_prefix') . ' ' . $eventType;
    }

}
