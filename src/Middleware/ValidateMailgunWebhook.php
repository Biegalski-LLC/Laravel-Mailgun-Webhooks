<?php

namespace Biegalski\LaravelMailgunWebhooks\Middleware;

use Closure;
use Illuminate\Http\Response;

/**
 * Validate Mailgun Webhooks
 * @see https://documentation.mailgun.com/user_manual.html#securing-webhooks
 * @gist https://gist.github.com/paulredmond/14523d3bd8062f9ce48cdd1340b3f171
 */
class ValidateMailgunWebhook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isMethod('post')) {
            abort(Response::HTTP_FORBIDDEN, 'Only POST requests are allowed.');
        }

        if ($this->verify($request)) {
            return $next($request);
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    /**
     * Build the signature from POST data
     *
     * @see https://documentation.mailgun.com/user_manual.html#securing-webhooks
     * @param  $request The request object
     * @return string
     */
    private function buildSignature($request)
    {
        return hash_hmac(
            'sha256',
            sprintf('%s%s', $request->input('signature.timestamp'), $request->input('signature.token')),
            config('services.mailgun.secret')
        );
    }

    /**
     * @param $request
     * @return bool
     */
    private function verify($request)
    {
        // Check if the timestamp is fresh
        if (abs(time() - $request->input('signature.timestamp')) > 15) {
            return false;
        }

        return $this->buildSignature($request) === $request->input('signature.signature');
    }
}
