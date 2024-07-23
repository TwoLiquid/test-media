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
     */
    public function up(): void
    {
        Schema::create('support_ticket_message_audios', function (Blueprint $table) {
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
     */
    public function down(): void
    {
        Schema::dropIfExists('support_ticket_message_audios');
    }
};
