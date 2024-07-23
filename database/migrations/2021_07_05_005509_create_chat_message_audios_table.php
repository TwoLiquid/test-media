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
        Schema::create('chat_message_audios', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->index();
            $table->text('url');
            $table->string('original_name')->nullable();
            $table->double('duration')->nullable();
            $table->double('size')->nullable();
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
        Schema::dropIfExists('chat_message_audios');
    }
};
