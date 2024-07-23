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
        Schema::create('review_message_images', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->index();
            $table->text('url');
            $table->double('size');
            $table->string('mime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_message_images');
    }
};
