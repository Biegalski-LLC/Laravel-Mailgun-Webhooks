<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailgunEventFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailgun_flags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id')->index();
            $table->boolean('is_routed')->default(0);
            $table->boolean('is_authenticated')->default(0);
            $table->boolean('is_system_test')->default(0);
            $table->boolean('is_test_mode')->default(0);
            $table->timestamps();

            $table->foreign('event_id')
                ->references('id')
                ->on('mailgun_events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailgun_flags');
    }
}
