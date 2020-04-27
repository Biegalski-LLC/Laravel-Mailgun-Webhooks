<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetForeignActionToMailgunEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('mailgun_events', static function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references( config('mailgun-webhooks.user_table.identifier_key') )->on( config('mailgun-webhooks.user_table.name') )->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('mailgun_events', static function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references( config('mailgun-webhooks.user_table.identifier_key') )->on( config('mailgun-webhooks.user_table.name') );
        });
    }
}
