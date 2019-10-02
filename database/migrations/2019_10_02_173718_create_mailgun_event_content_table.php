<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailgunEventContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailgun_event_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id')->index();
            $table->string('subject')->nullable();
            $table->string('to')->nullable();
            $table->string('content_type')->nullable();
            $table->string('message_id')->nullable();
            $table->text('stripped_text')->nullable();
            $table->longText('stripped_html')->nullable();
            $table->longText('body_html')->nullable();
            $table->mediumText('body_plain')->nullable();
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('mailgun_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailgun_event_content');
    }
}
