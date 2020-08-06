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
            
            // Required for inspecting column type of tables with enum fields in it
            DB::getDoctrineConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

            if(Schema::getColumnType('users', 'id') === 'integer'){
                $colType = 'unsignedInteger';
            }else{
                $colType = 'unsignedBigInteger';
            }

            $table->bigIncrements('id');
            $table->enum('event_type', config('mailgun-webhooks.event_types') )->index();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string('uuid');
            $table->string('recipient_domain')->nullable();
            $table->string('recipient_user')->nullable();
            $table->string('msg_to')->nullable();
            $table->string('msg_from')->nullable();
            $table->string('msg_subject')->nullable();
            $table->string('msg_id')->nullable();
            $table->integer('msg_code')->nullable();
            $table->integer('attempt_number')->default(1);
            $table->boolean('attachments')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references( config('mailgun-webhooks.user_table.identifier_key') )
                ->on( config('mailgun-webhooks.user_table.name') )
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
        Schema::dropIfExists('mailgun_events');
    }
}
