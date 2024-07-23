<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Running MySQL migration
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('chat_message_videos', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->index();
            $table->text('url');
            $table->double('duration');
            $table->double('size');
            $table->string('mime');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('chat_message_videos');
    }
};
