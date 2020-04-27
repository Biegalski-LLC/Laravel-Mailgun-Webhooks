<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetForeignActionToMailgunFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('mailgun_flags', static function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->foreign('event_id')->references('id')->on('mailgun_events')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('mailgun_flags', static function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->foreign('event_id')->references('id')->on('mailgun_events');
        });
    }
}
