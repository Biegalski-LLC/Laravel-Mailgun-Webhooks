<?php

Route::group(['middleware' => ['mailgun_webhooks']], function () {
    Route::prefix('api/mailgun-webhooks')->name('mailgun.')->group(function () {
        Route::post('{type}', '\Biegalski\LaravelMailgunWebhooks\Http\Controllers\MailgunWebhooksController@messageType')->name('messageType');
    });
});
