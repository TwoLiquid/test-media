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
        Schema::create('review_message_video_thumbnails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('video_id')->unsigned()->index();
            $table->text('url');
            $table->string('mime');

            $table->foreign('video_id')
                ->references('id')
                ->on('review_message_videos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_message_video_thumbnails');
    }
};
