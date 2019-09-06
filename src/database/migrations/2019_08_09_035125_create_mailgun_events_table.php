<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailgunEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailgun_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_type_id')->index();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string('uuid');
            $table->string('recipient_domain');
            $table->string('recipient_user');
            $table->string('msg_to')->nullable();
            $table->string('msg_from')->nullable();
            $table->string('msg_subject')->nullable();
            $table->string('msg_id')->nullable();
            $table->integer('msg_code')->nullable();
            $table->integer('attempt_number')->default(1);
            $table->boolean('attachments')->default(0);
            $table->timestamps();
            $table->foreign('event_type_id')->references('id')->on('mailgun_types');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailgun_events');
    }
}
