<?php


Route::prefix('api/mailgun-webhooks')->name('mailgun.')->group(function () {
    Route::post('delivered-messages', '\Biegalski\LaravelMailgunWebhooks\Http\Controllers\MailgunWebhooksController@deliveredMessages')->name('deliveredMessages');
});

/*Route::group(['middleware' => ['web']], function () {
    //
});*/
