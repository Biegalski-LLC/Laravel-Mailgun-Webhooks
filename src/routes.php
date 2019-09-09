<?php

/**
 * Mailgun Webhooks Middleware Route Group
 */
Route::group(['middleware' => ['mailgun_webhooks']], function () {

    /**
     * Prefixed and Named Route Group
     */
    Route::prefix('api/mg-webhooks')->name('mailgun.')->group(function () {

        /**
         * Route
         */
        Route::post('{type}', '\Biegalski\LaravelMailgunWebhooks\Http\Controllers\MailgunWebhooksController@messageType')->name('messageType');
    });
});
